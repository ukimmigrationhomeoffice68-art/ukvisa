import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore";
import { getAuth } from "firebase/auth";
import { getStorage } from "firebase/storage";

const firebaseConfig = {
  apiKey: "AIzaSyDjR5JhF5-QFnc1_NZXX_VgmNqJYltRzVM",
  authDomain: "uk-visa-4a9f0.firebaseapp.com",
  projectId: "uk-visa-4a9f0",
  storageBucket: "uk-visa-4a9f0.firebasestorage.app",
  messagingSenderId: "399950776271",
  appId: "1:399950776271:web:813cc03e5dddb41311b4ba",
  measurementId: "G-0694SRSK17"
};

const app = initializeApp(firebaseConfig);
export const db = getFirestore(app);
export const auth = getAuth(app);
export const storage = getStorage(app);
export default app;
