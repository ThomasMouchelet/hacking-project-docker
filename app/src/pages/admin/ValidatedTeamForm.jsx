import { useEffect, useState } from "react";
import teamAPI from "../../services/teamAPI";
import ValidetedTeamList from "./ValidetedTeamList";

const ValidatedTeamForm = () => {
    const [teams, setTeams] = useState([])
    const [selected,setSelected] = useState(null)

    useEffect(() => {
        fetchAllTeams()
    },[])

    const fetchAllTeams = async () => {
        try {
            const data = await teamAPI.findAllTeams()
            setTeams(data)
        } catch (e) {
            console.log(e)
        }
    }

    const handleSubmit = async (e) => {
        e.preventDefault()
        try {
            await teamAPI.updateTeam(selected)
            fetchAllTeams()
        } catch (error) {
            console.log(error)
        }
    }

    const handleChange = ({currentTarget}) => { 
        setSelected(currentTarget.value)
    }

    return ( 
        <div >
            <h2>Valider ma team</h2>
            <form action="" className="tchat-form" onSubmit={handleSubmit}>
                <select name="team" onChange={handleChange}>
                    <option>-- SELECT TEAM --</option>
                    {teams.map(team => (
                        <option value={team.id}>{team.name}</option>
                    ))}
                </select>
                <button type="submit">Valider</button>
            </form>

            <ValidetedTeamList 
                teams={teams}
                setTeams={setTeams}
            />
        </div>
     );
}
 
export default ValidatedTeamForm;