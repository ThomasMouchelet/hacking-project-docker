import React, { useState, useContext, useEffect, useRef } from "react";
import ReactPlayer from 'react-player';
import { Link } from "react-router-dom";
import firebasedb from "../firebasedb";
// import { getFirestore, collection, getDocs } from 'firebase/firestore';

const VideoPage = () => {
    const [url, setUrl] = useState(`${window.location.origin}/assets/mistert.mp4`)
    const playerRef = useRef()
    const [playing, setPlaying] = useState(false)
    const [controls, setControls] = useState(false)

    useEffect(() => {
        fetchVideo()
    }, [playing,controls])

    const fetchVideo = async () => {
        firebasedb.collection("video").doc("mistert")
            .onSnapshot((doc) => {
                const data = doc.data()
                setPlaying(data.playing)
                setControls(data.controls)
            });
    }

    return (
        <div className="videoPage">

            <Link className="btn btn-success" to="/login">Login</Link>

            <ReactPlayer
                ref={playerRef}
                className='react-player'
                width='100%'
                height='100%'
                url={url}
                playing={playing}
                controls={controls}
            />
        </div>
    )
}

export default VideoPage;