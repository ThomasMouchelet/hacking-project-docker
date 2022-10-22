import React, { useState, useContext, useEffect } from "react";
import teamAPI from "../services/teamAPI";
import userAPI from "../services/usersAPI";
import tudentAPI from "../services/studentAPI";
import studentAPI from "../services/studentAPI";
import AuthContext from "../contexts/AuthContext";
import authAPI from "../services/authAPI";
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

const CreateTeamPage = () => {
    const [studentTeam, setStudentTeam] = useState(null)
    const [userSecretKeyValue, setUserSecretKeyValue] = useState([])
    const [isLoading, setIsLoading] = useState(false)
    const [winMode, setWinMode] = useState(false)
    const { setIsAuthenticated } = useContext(AuthContext);

    useEffect(() => {
        authAPI.setup();
        const studentTeamID = userAPI.getStudentTeamID()
        fetStudentTeam(studentTeamID)
        if (isLoading) {
            let totalUserSecretKeyValue = ""
            Object.keys(userSecretKeyValue).map((index, key) => {
                totalUserSecretKeyValue += userSecretKeyValue[index]
            })
            if (totalUserSecretKeyValue === studentTeam.secretKey) {
                setWinMode(true);
            }
        }
    }, [])

    useEffect(() => {
        let counter = 0;
        userSecretKeyValue.map(student => {
            if(student.value === student.secret){
                counter++
            }
        })
        if(counter === userSecretKeyValue.length){
            setWinMode(true)
        } else {
            setWinMode(false)
        }
    }, [userSecretKeyValue])

    const fetStudentTeam = async (id) => {
        try {
            const result = await teamAPI.findOne(id)
            setStudentTeam(result);
            
            let secrets = []
            result.students.map((student, index) => {
                secrets.push({
                    placeholder: student.firstName,
                    secret: student.secretKey,
                    value: ""
                })
            })
            setUserSecretKeyValue(secrets)
            setIsLoading(true)
        } catch (error) {
            console.log(error)
        }
    }

    const handleChange = (e, index) => {
        const { value, name } = e.target;
        userSecretKeyValue[index].value = value;
        setUserSecretKeyValue([...userSecretKeyValue])
        if (isLoading) {
            if(userSecretKeyValue[index].secret == value){
                e.target.className = "valid"
            } else {
                e.target.className = ""
            }
        }
    };


    const handleLogout = () => {

        toast.dark(studentTeam.name, {
            position: "top-right",
            autoClose: 9000,
            hideProgressBar: false,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            progress: undefined,
        });

        toast.dark("123", {
            position: "top-right",
            autoClose: 9000,
            hideProgressBar: false,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            progress: undefined,
        });

        authAPI.logout();
        setIsAuthenticated(false);
    }

    const winModView = (
        <div className="winMod">
            <button onClick={handleLogout}>Team connection</button>
            <p>Password : <em>123</em></p>
        </div>
    )

    return (
        <div className="create-team">
            <h1>Create Team</h1>
            <div>
                Bienvenue à vous, votre petit nom d’équipe sera <em>{isLoading && studentTeam.name}</em>
                <br />
                Avant de commencer… il va falloir trouver qui seront vos collaborateurs.
                <br />
                Chacun des membres de votre équipe a simplement à entrer le code qui lui a été confié précédemment dans le champs qui lui est réservé.
                <br />
                Pour rappel votre code secret est le suivant : <em>{studentAPI.getStudentSecretKey()}</em>
                <br />
                L'identifiant de connexion de votre team : <em>{isLoading && studentTeam.name}</em>
                <br />
                Bon courage !
                <br />
            </div>

            <form>
                {userSecretKeyValue && userSecretKeyValue.map((value, index) => (
                    <input key={index} type="text" onChange={(e) => handleChange(e, index)} name={index} placeholder={`code ${index+1}`} />
                ))}
            </form>
            {winMode && winModView}
        </div>
    )
}

export default CreateTeamPage;