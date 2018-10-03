package main

	import "fmt"
	import "flag"
	import "regexp"
	import "strings"

	func main(){
		address := flag.String("address", "", "Address")
		var flat []string
		var homeStr string
		var numHome string
		var addrStr []string

		flag.Parse()

		strAddress := *address

		fmt.Println("Address indicated:", strAddress)

                if len(strAddress) > 0{
			reFlat := regexp.MustCompile(`(Flat\s*\d+|Apartment\s*\d+|Apt\s*\d+|Basement Falt\s*\d+|G\/\s*\d+|Garden Flat\s*\d+|Ground Floor Flat\s*\d+|Lower Flat\s*\d+)`)
			reString := regexp.MustCompile(`(\s[A-Za-z\s]+)`)
			reHome := regexp.MustCompile(`[0-9A-Za-z\-]+`)
			flat=reFlat.FindAllString(strings.TrimSpace(strAddress), 1)
			if flat!=nil && len(flat[0]) > 0{
				fmt.Println("Flat Num:",flat[0])
				homeStr=reFlat.ReplaceAllString(strAddress, "")
			} else {
				homeStr=strAddress
			}

			addrStr=reString.FindAllString(strings.TrimSpace(homeStr),1)
                        restAddr := reString.ReplaceAllString(homeStr, "")
			if reHome.MatchString(restAddr){
                                 numHome=restAddr
                         } else {
                                 numHome=""
                         }
			 fmt.Println("Street Name:", addrStr[0])
			 fmt.Println("Home Num:", numHome)
		} else {
			fmt.Println("Indicate Address for parsing")
		}
	}
	/*
		Run example 
		$ ./tstlin -address="10a Waterloo Street"
		OS: Ubuntu
	*/
