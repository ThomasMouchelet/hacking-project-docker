import firebase from "firebase";
// Required for side-effects
require("firebase/firestore");

// Initialize Cloud Firestore through Firebase
firebase.initializeApp({
    apiKey: "AIzaSyC2lJL4ixVJZ5W0o40VrbkqkdUcqGJ1ZKg",
    authDomain: "tchat-esd.firebaseapp.com",
    databaseURL: "https://tchat-esd.firebaseio.com",
    projectId: "tchat-esd",
    storageBucket: "tchat-esd.appspot.com",
    messagingSenderId: "480169967880",
    appId: "1:480169967880:web:23b546f97de24a1caa6cbd"
  });
  
const firebasedb = firebase.firestore();

export default firebasedb