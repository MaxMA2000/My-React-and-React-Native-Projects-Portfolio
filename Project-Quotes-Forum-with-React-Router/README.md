# Quotes Forum with React Router



## What is this project?

- This is a Quote Forum where users can upload and view quotes
- Users can change the sorting orders of quotes in the first page
- Users can go to other pages, such as `quote detail page`, `add quote page`, etc
- In the `quote detail page`, users can also load and comment below
- In the `add quote page`, users can upload a quote
- All the quotes & comments are stored in the Firebase backend, users can reload the page and all quotes & comments will show up, there is also a loading page when users are loading the quotes / comments



## How to Run this project?

- Download the project folder and run `npm install` to install all the packages
- Set up the HTTP backend
  - Create an account and a project on the [Firebase](https://firebase.google.com/)
  - Then create a "read-time-database" under your firebase project
  - Change yoru "real-time-database" URL in the `cart-actions.js` file in the `store` folder
- Run `npm start`