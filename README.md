As an expert and season develop I want to design the AI document summarizer as follows: 
Make it as nice as possible and add anything that makes my app a nice one, 
Configure the routes and all good practices when developing Laravel application

Login Page
- Logo
- username or email
- password
- reCAPTCHA
- submit button

Form
- Document Name (input field - name=docName)
- filename (file/browse - name=filename)
- Enter GPT Prompt (Textarea name=gpt_prompt)
- Submit for processing (button type=submit)

Note: 
- I want that the document be previewed - provide for this
- document should be stored in a given folder on the application and document reference saved in field =filename

Review data:
after the GPT API returns the results, they should saved in the field =gpt_processed_data
Create and another page where all data is retrieved from the DB

Database structure: I want to use migrations 
Table1 should hand user Authentication data
Table2 shoud handle data for document processing with fields including (id, docName, filename, gpt_prompt, gpt_processed_data, created_by, timestamps)


AINEDEMBE DENIS
+256 788-674576
LinkedIn: www.linkedin.com/in/ainedembe-denis-2b329615a