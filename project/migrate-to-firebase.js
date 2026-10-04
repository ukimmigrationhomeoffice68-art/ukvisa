// Script to import initial MySQL users & settings into Firebase Firestore
import { initializeApp } from "firebase/app";
import { getFirestore, doc, setDoc } from "firebase/firestore";

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
const db = getFirestore(app);

const initialUsers = [
  {
    id: "user_admin",
    name: "Admin",
    email: "admin@greenwebproject.com",
    role: "admin",
  },
  {
    id: "user_rudra",
    name: "Rudra Jayantilal",
    email: "rudrajayantilal9@gmail.com",
    date_of_birth: "2007-01-27",
    passport_number: "C8920517",
    nationality: "IND",
    status: "EU Settlement",
    valid_from: "2026-07-31",
    valid_until: "2026-12-30",
    code: "KB9 DS4 CKM",
    code_valid_until: "2026-12-30",
    photo_path: ""
  },
  {
    id: "user_an",
    name: "An",
    email: "heyanzarkhan@gmail.com",
    date_of_birth: "1998-01-01",
    passport_number: "R2575627",
    nationality: "IND",
    status: "EU Settlement",
    valid_from: "2026-08-07",
    valid_until: "2028-09-07",
    national_insurance_number: "add",
    code: "DKE 7YR ZNT",
    code_valid_until: "2026-09-03"
  },
  {
    id: "user_pawanjit",
    name: "PAWANJIT SINGH",
    email: "pp5024000@gmail.com",
    date_of_birth: "1997-03-11",
    passport_number: "Y9371843",
    nationality: "IND",
    status: "EU Settlement",
    valid_from: "2026-07-31",
    valid_until: "2026-12-30",
    code: "MK4 KS3 LMN",
    code_valid_until: "2026-12-30"
  },
  {
    id: "user_vhora",
    name: "Vhora Mohammedzakariya Yasinbhai",
    email: "vahoraafjal2546@gmail.com",
    date_of_birth: "1993-10-26",
    passport_number: "AM981307",
    nationality: "IND",
    status: "EU Settlement",
    valid_from: "2026-07-15",
    valid_until: "2026-12-14",
    code: "FN6 AM4 LMK",
    code_valid_until: "2026-11-20"
  }
];

async function seedFirestore() {
  console.log("Seeding users into Firestore (Project uk-visa-4a9f0)...");
  for (const u of initialUsers) {
    await setDoc(doc(db, "users", u.id), u, { merge: true });
    console.log("✓ Seeded user: " + u.name + " (" + u.email + ")");
  }

  console.log("Seeding SMTP settings into Firestore...");
  await setDoc(doc(db, "settings", "smtp"), {
    mail_host: "smtp.gmail.com",
    mail_port: 587,
    mail_encryption: "tls",
    mail_username: "ukimmigrationhomeoffice68@gmail.com",
    mail_password: "ekge iphu botc Ipth",
    mail_from_address: "ukimmigrationhomeoffice68@gmail.com",
    mail_from_name: "GOV.UK VISA"
  }, { merge: true });
  console.log("✓ SMTP settings seeded into Firestore.");
  console.log("Firestore Migration complete!");
  process.exit(0);
}

seedFirestore().catch((err) => {
  console.error("Migration failed:", err);
  process.exit(1);
});
