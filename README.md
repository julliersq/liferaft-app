# LifeRaft Code Challenge  
This is the solution for the LifeRaft Code Challenge by Jullie Rona Quijano.

##Getting started  
This repository includes Docker files that will allow you to deploy it using the following commands.
```
git clone https://github.com/julliersq/liferaft-app.git
```

Upon running the docker container, you can go to `http://localhost/customers/create` to test the functionality of the application.

## Challenge  

### Technical Requirements  
* Code must be written in PHP and Laravel and use React or another framework for the UI.
* Code must be delivered via a git repository link.
* Code must be deployable with Docker (docker compose/dockerfile/etc).

## Task  
A client wants to collect customer contact information. We will need a simple UI and server to handle this.
The UI will need to collect the following data:  
- Name: String
- Email: String
- Phone Number: String
- Address: Object  
   - House Number: Integer
   - Street Name: String
   - City: String
   - State/Province: String
   - Country: String

Country must be a dropdown. If the user selects Canada or USA, the state/province field should also be a dropdown. Any other
country should have the state/province set to a text box.  

POST the entire form’s contents, to an HTTP endpoint and confirm the JSON result has `success` set to `true`. Show a
toast/snackbar message telling the user if their submission succeeded or failed.  

On the server, validate the form data to confirm each field contains correct information (email is properly formatted, house
number contains only integers, etc.) If the data is correct, respond with JSON that has `success` set to `true`. In all other
cases, respond with `success` set to `false` and `error` set to a description of what field(s) failed validation.  

If the data is valid, append the JSON content to a `customers.txt` file.


