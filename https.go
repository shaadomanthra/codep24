package main


import (
	"encoding/json"
	"fmt"
	"github.com/prasmussen/glot-code-runner/cmd"
	"github.com/prasmussen/glot-code-runner/language"
	"io/ioutil"
	"os"
	"path/filepath"
	"net/http"
)

func hello(w http.ResponseWriter, req *http.Request) {


	keys, ok := req.URL.Query()["key"]

    
    if !ok || len(keys[0]) < 1 {
        fmt.Println("Url Param 'key' is missing")
        fmt.Fprintf(w, "Url Param 'key' is missing " )
        return
    }

    // Query()["key"] will return an array of items, 
    // we only want the single item.
    arg := keys[0]


    fmt.Println("Url Param 'key' is: " + string(arg))

	payload := &Payload{}

	
	
	data, err := ioutil.ReadFile(arg+".json")
    if err != nil {
        fmt.Println("File reading error", err)
        return
    }

    fmt.Fprintf(w, string(data))

	json.Unmarshal([]byte(data), &payload)

	if err != nil {
		exitF("Failed to parse input json (%s)\n", err.Error())
	}



	// Ensure that we have at least one file
	if len(payload.Files) == 0 {
		exitF("No files given\n")
	}

	// Check if we support given language
	if !language.IsSupported(payload.Language) {
		exitF("Language '%s' is not supported\n", payload.Language)
	}

	// Write files to disk
	filepaths, err := writeFiles(payload.Files)
	if err != nil {
		exitF("Failed to write file to disk (%s)", err.Error())
	}

	var stdout, stderr string

	// Execute the given command or run the code with
	// the language runner if no command is given
	if payload.Command == "" {
		stdout, stderr, err = language.Run(payload.Language, filepaths, payload.Stdin)
	} else {
		workDir := filepath.Dir(filepaths[0])
		stdout, stderr, err = cmd.RunBashStdin(workDir, payload.Command, payload.Stdin)
	}
	
	writer(stdout,"logs/stdout_"+arg)
	writer(stderr,"logs/stderr_"+arg)
	writer(errToStr(err),"logs/err_"+arg)

	printResult(stdout, stderr, err)

    fmt.Fprintf(w, "hello\n")
}

func headers(w http.ResponseWriter, req *http.Request) {

    for name, headers := range req.Header {
        for _, h := range headers {
            fmt.Fprintf(w, "%v: %v\n", name, h)
        }
    }
}





type Payload struct {
	Language string          `json:"language"`
	Files    []*InMemoryFile `json:"files"`
	Stdin    string          `json:"stdin"`
	Command  string          `json:"command"`
}

type InMemoryFile struct {
	Name    string `json:"name"`
	Content string `json:"content"`
}

type Result struct {
	Stdout string `json:"stdout"`
	Stderr string `json:"stderr"`
	Error  string `json:"error"`
}

func main() {
	

	http.HandleFunc("/hello", hello)
    http.HandleFunc("/headers", headers)

    http.ListenAndServe(":8090", nil)


}

// Writes files to disk, returns list of absolute filepaths
func writeFiles(files []*InMemoryFile) ([]string, error) {
	// Create temp dir
	tmpPath, err := ioutil.TempDir("", "")
	if err != nil {
		return nil, err
	}

	paths := make([]string, len(files), len(files))
	for i, file := range files {
		path, err := writeFile(tmpPath, file)
		if err != nil {
			return nil, err
		}

		paths[i] = path

	}
	return paths, nil
}

func writer(stdout string,name string){
	f, err := os.Create(name+".txt")
    if err != nil {
        fmt.Println(err)
        return
    }
    l, err := f.WriteString(stdout)
    if err != nil {
        fmt.Println(err)
        f.Close()
        return
    }
    fmt.Println(l, "bytes written successfully")
    err = f.Close()
    if err != nil {
        fmt.Println(err)
        return
    }
}

// Writes a single file to disk
func writeFile(basePath string, file *InMemoryFile) (string, error) {
	// Get absolute path to file inside basePath
	absPath := filepath.Join(basePath, file.Name)

	// Create all parent dirs
	err := os.MkdirAll(filepath.Dir(absPath), 0775)
	if err != nil {
		return "", err
	}

	// Write file to disk
	err = ioutil.WriteFile(absPath, []byte(file.Content), 0664)
	if err != nil {
		return "", err
	}

	// Return absolute path to file
	return absPath, nil
}

func exitF(format string, a ...interface{}) {
	fmt.Fprintf(os.Stderr, format, a...)
	os.Exit(1)
}

func printResult(stdout, stderr string, err error) {
	result := &Result{
		Stdout: stdout,
		Stderr: stderr,
		Error:  errToStr(err),
	}
	
	
	json.NewEncoder(os.Stdout).Encode(result)
}

func errToStr(err error) string {
	if err != nil {
		return err.Error()
	}

	return ""
}
