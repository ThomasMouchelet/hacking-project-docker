import { useEffect, useState } from "react";
import teamAPI from "../../services/teamAPI";
import Moment from 'react-moment';

const ValidetedTeamList = ({teams,setTeams}) => {

    return ( 
        <div>
            <ul>
                {teams.map(team => (
                    <li key={team.id}>
                        <strong>
                            {team.name} : 
                        </strong>
                        {team.completedAt ? (
                            <span> -
                                <Moment format="DD/MM/YYYY - HH:mm:ss">{team.completedAt}</Moment>
                            </span>
                        ) : (
                            <span>
                                --
                            </span>
                        )}
                    </li>  
                ))}
            </ul>
        </div>
     );
}
 
export default ValidetedTeamList;