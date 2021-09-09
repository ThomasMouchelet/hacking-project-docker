import { useEffect, useState } from "react";
import cat from "../cat-nyan-cat.gif"
import firebasedb from "../firebasedb";
import usersAPI from "../services/usersAPI";


const Nyancat = () => {
    const [gameoptions, setGameoptions] = useState({
        nyancat: false
    })
    const [isAdmin,setIsadmin] = useState(usersAPI.isAdmin())

    useEffect(()=>{
        fetchGameoptions()
    },[])

    const fetchGameoptions = async () => {
        firebasedb.collection("game").doc("options")
            .onSnapshot((doc) => {
                const data = doc.data()
                setGameoptions(data)
            });       
    }

    return ( 
        <div className={isAdmin && 'admin'} >
            {gameoptions.nyancat && (
                <div className="nyan-cat show">
                    <img src={cat} alt="" />
                </div>
            )}
        </div>
     );
}
 
export default Nyancat;