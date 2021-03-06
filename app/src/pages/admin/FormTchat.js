import React, { useState, useContext, useEffect } from "react";
import firebasedb from "../../firebasedb";

const FormTchat = () => {
    const [credentials, setCredentials] = useState({
        message: ""
    })

    const handleChange = ({ currentTarget }) => {
        const { value, name } = currentTarget;
        setCredentials({ ...credentials, [name]: value });
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        const dateTime = String(Date.now());
        firebasedb.collection("tchat").doc(dateTime).set({
                message: credentials.message
            });

        setCredentials({ message: "" })
    }

    return (
        <div>
            <h2>Envoyer un message</h2>
            <form onSubmit={handleSubmit} className="tchat-form">
                <textarea
                    type="text" placeholder="message"
                    onChange={handleChange}
                    value={credentials.message}
                    name="message"
                />
                <button type="submit">Envoyer</button>
            </form>

        </div>
    )
}

export default FormTchat;