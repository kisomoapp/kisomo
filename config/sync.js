
const ping = async() => {
    $.ajax({
        url:'../config/checkNetwork.php',
        success:function(response)
        {
            if(response.trim().indexOf("unreachable") === -1)
            { //success
                synchronize();
            }else 
            {
                setTimeout(()=>{
                  
                    ping();
                },600000);
            }
        }
    });
}

const init =  () => {
    var res = ping();
}

function synchronize(){

        $.ajax({
            url:"../config/fetchLocalLogs.php",
            method:"POST",
            dataType:'text',
            success:function(res)
            {

                if(!(res.trim()==="empty"))
                {

                    var rows = JSON.parse(res);
                    rows.logs_data.forEach(($row,index) => 
                    {
                         var  action=$row.action;
                         var dateTime=$row.dateTime;
                         var logId=$row.log_id;
                         var schoolCode=$row.school_code;
                         var duration=$row.duration;
                         var school_login_id=$row.school_login_id;
                         var res= $.ajax({
                                url:"https://kisomo.co.tz/kisomo%20app/kisomo_schools/backend/logs/synchronizeMaster.php",
                                method:"POST",
                                data:{student_login_id:school_login_id,action:action,dateTime:dateTime,schoolCode:schoolCode,duration:duration}
                                 });
                        res.done((response)=>{
                            if(response.trim()==="success"){
                                 // update local row
                               var res= $.ajax({
                                    url:"../config/updateLocalServer.php",
                                    method:"POST",
                                    data:{logId:logId}
                                });
                                res.done((response)=>{
                                });
                            }
                        });
    
                    });
    
                }

            }
    });
}

setInterval(function ()
{   
    init();
}
, 180000);
