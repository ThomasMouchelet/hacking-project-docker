import React, { useState, useContext, useEffect } from "react";
import studentAPI from "../services/studentAPI";

const StudentList = () => {
    const [isLoading, setIsLoading] = useState(false)
    const [studentList, setStudentList] = useState(null)

    useEffect(() => {
        fetAll()
    }, [isLoading])

    const fetAll = async () => {
        try {
            const students = await studentAPI.getAll()
            console.log(students)
            setStudentList(students)
            setIsLoading(true)

        } catch (error) {
            console.log(error)
        }
    }

    return (
        <div className="studentList">
            {isLoading && Object.values(studentList).map((student, key) => {
                return (
                    <div key={key}>
                        {student.firstName} {student.lastName} : {student.user.username}
                    </div>
                )
            })}

        </div>
    )
}

export default StudentList;