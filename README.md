# user-registration app
 [PHP] web application to register a user based on validation constraints and then save the collected information into a file.  
 Practice from <a href url= "https://continuingeducation.johnabbott.qc.ca/programs/full-stack-developer/"> Full-Stack Developer Web Development I.420-WE6-AB</a>.  
 ***
### Validation Constraints
- The email entry must follow a valid email format ('@' and '.' chars)
- The fields 'password' and 'retype password' must be hidden and match each
other.
- The password should be at least 10 chars and include exactly one special
character, one uppercase letter and one digit
- First name must have up to 10 chars, only letters [A-Z], with no space
- Last name must have up to 15 chars, only letters [A-Z), with no more than one
blank space
- Phone number entry should start with a ‘+’ followed by up to 15 digits.
- Address entry should contain street number and street name separated with
blank space
- Town is an optional entry with up to 15 characters without space.
- Region entry takes between 2 to 3 letters [A-Z].
- Postcode entry is a 6 characters field based on Canadian postal code format (1st,
3rd and 5th char is a capital letter and 2nd, 4th and 6th char is a digit [0-9]. A single
blank space must be included between the 3 first and 3 last chars.
- Country between 4 to 15 characters, must start with uppercase letter only and
the rest of chars are lowercase
-----
### Register button
- Upon clicking on this button, all the validation constraints must be visible in front
of the fields that do not satisfy the requirements.
- If all requirements are satisfied, the information should be stored in a file called
user.txt for every submission. The data should be saved vertically (one row
corresponds to one entry field).
- A double empty line must be respected between two adjacent user details in the
file.
