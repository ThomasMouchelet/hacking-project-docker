import firebase from "firebase";
// Required for side-effects
require("firebase/firestore");

// Initialize Cloud Firestore through Firebase
firebase.initializeApp({
  apiKey: "AIzaSyDbjR8CLPi7GyCwkG7kOSiRdnI4eOwsz7E",
  authDomain: "hacking-7d369.firebaseapp.com",
  projectId: "hacking-7d369",
  storageBucket: "hacking-7d369.appspot.com",
  messagingSenderId: "697318806",
  appId: "1:697318806:web:f504fb682b1217106eb1b7"
    // apiKey: "AIzaSyC2lJL4ixVJZ5W0o40VrbkqkdUcqGJ1ZKg",
    // authDomain: "tchat-esd.firebaseapp.com",
    // databaseURL: "https://tchat-esd.firebaseio.com",
    // projectId: "tchat-esd",
    // storageBucket: "tchat-esd.appspot.com",
    // messagingSenderId: "480169967880",
    // appId: "1:480169967880:web:23b546f97de24a1caa6cbd"
  });
  
const firebasedb = firebase.firestore();

export default firebasedb