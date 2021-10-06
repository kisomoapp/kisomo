var selectedStreamId="";
var selectedSubjectId="";
var selectedSubjectName="";
var selectedSubjectTopic="";
var selectedStreamName="";
var selectedStreamid;
var selectedTopic="";
var lock=false;

var compareTokenLock=false;

if(!(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/'))
{
    getSubjects();
    getExtraCourses();
    loadNews();
}
$('#index-sign-btn').click(()=>{

    if(verifySignFields())
    {
        SignIn();
    }
    // window.location.href='pages/';
});

$('.header-top .logo').click(()=>
{
    
    if(
        (window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/home')  ||  
        (window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/news')  ||
        (window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/calendar') ||
        (window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/notes') ||
        (window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/profile')
     )
    {
        calendarDurationRecorder();
        resetMenuItemIcons();
        newsDurationRecorder();
        setTimeout(()=>{
            $('#home-icon').css('fill','rgb(45, 150, 255');
            $('#home-icon-txt').css('color','rgb(45, 150, 255');
            window.location.href='home';
        },10);
    }

});
$('.greeting').css('visibility','visible');
$('.greeting').css('opacity','1');
if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/home')
{
    setHelloStudentName(); 
}
if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/')
{
    setHelloStudentName(); 
}
function setHelloStudentName()
{
    $getStudentName=$.ajax(
    {
        url:"../assets/php/getStudentName.php",
    });
    $getStudentName.done(function(response)
    {
        if(response.trim()==="")
        {
            //alert('empty');
        }
        else
        {
            fname=response.split(' ')[0];
            $('.greeting').html("Mambo "+fname+",")
        }
        
    }
    );
}
if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/')
{
    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            if ( $('#passwd-sign-input-txt').is(':focus') || $('#username-sign-input-txt').is(':focus') )
            {
               
                if(verifySignFields())
                {
                    SignIn();
                }
            }
        }
    });
    
    $('#passwd-sign-input-txt').on('keyup',function(){
        $('#passwd-sign-input-txt').css('border','1px solid #666');
    });
    
    $('#username-sign-input-txt').on('keyup',function(){
        $('#username-sign-input-txt').css('border','1px solid #666');
    });
}


$('.dash-logout-btn').click(()=>{
    logout(); 
});
$('.logout-btn').click(function()
    {
        logout();  
    }
)


function logout()
{
    var recordTopicLogDuration=$.ajax({
        url:"../assets/php/recordTopicLogDuration.php",
    });
    recordTopicLogDuration.done(()=>
    {
            $.ajax
            (
                {
                    url:"../assets/php/signout.php",
                    success:function(response)
                    {
                        if(response.trim()==="success")
                        {
                            $('.logout-btn').html('sign out...');
                            window.location.href='../';
                        }
                    }
                }
            );
    });
}

function verifySignFields()
{
    if(
        $('#passwd-sign-input-txt').val().trim()!="" &&
        $('#username-sign-input-txt').val().trim()!=""
    )
    {
        return true;
    }
    else
    {
        if($('#passwd-sign-input-txt').val().trim()!="")
        {
            $('#username-sign-input-txt').css('border','1px solid red');
            message(1,"username is required");
        }
        else if($('#username-sign-input-txt').val().trim()!="")
        {
            $('#passwd-sign-input-txt').css('border','1px solid red');
            message(1,"password is required");
        }
        else
        {
            $('#passwd-sign-input-txt').css('border','1px solid red');
            $('#username-sign-input-txt').css('border','1px solid red');
            message(1,"All fields required");
        }
        return false;
    }
  

}
 function message(status,message)
 {
    $('.signin-message').css('visibility','visible');
    $('.signin-message').css('opacity','1');
    $('.message').html(message);
     if(status==1)
     {
        $('.message').css('color','red');
        hideSignInMessage();
     }
      else if(status==2)
     {
        $('.message').css('color','dodgerblue');
     }
     else if(status==3)
     {
        hideSignInMessage();
        $('.message').css('color','green');
     }
 }
 function hideSignInMessage(){
     setTimeout(()=>
     {
        $('.signin-message').css('visibility','hidden');
        $('.signin-message').css('opacity','0');
     },4000);
 }

 //signin page

function SignIn()
{
    message(2,"Please wait...");
    $username=$('#username-sign-input-txt').val();
    $password=$('#passwd-sign-input-txt').val();
    var signin=$.ajax(
        {
            url:"assets/php/signin.php",
            method:"POST",
            data:{username:$username,password:$password},
        });
    signin.done(function(response)
    {
        if(response.trim()==="error")
        {
            message(1,'Incorrect username or password');
        }
        else if(response.trim()==="success")
        {

            token()
        }
        else
        {
            message(1,"Something went wrong,try Again.");
        }

    });
}

$('#menu-item-home').click(()=>{


    calendarDurationRecorder();
    resetMenuItemIcons();
    newsDurationRecorder();
    setTimeout(()=>{
        $('#home-icon').css('fill','rgb(45, 150, 255');
        $('#home-icon-txt').css('color','rgb(45, 150, 255');
        window.location.href='home';
    },10);
    
});

$('#menu-item-quiz').click(()=>{
    calendarDurationRecorder();
    newsDurationRecorder();
    setTimeout(()=>{
        window.location.href='notes';
    },20);
});
$('#menu-item-calendar').click(()=>{
    newsDurationRecorder();
    setTimeout(()=>{
        recordCalendarLog();
    },20);
});

$('#menu-item-news').click(()=>{
    recordNewsLog();
    setTimeout(()=>{
        calendarDurationRecorder();
    },20)
});

function recordNewsLog()
{
  var recordNewsLog=$.ajax(
      {
          url:"../assets/php/recordNewsLog.php",
      }
  );  
  recordNewsLog.done(function()
  {
    window.location.href='news';
  });
}
function recordCalendarLog()
{
  var recordNewsLog=$.ajax(
      {
          url:"../assets/php/recordCalendarLog.php",
      }
  );  
  recordNewsLog.done(function()
  {
    window.location.href='calendar';
  });
}
$('#menu-item-profile').click(()=>{
    newsDurationRecorder();
    calendarDurationRecorder();
    setTimeout(()=>{
        window.location.href='profile';
    },20);
});

function resetMenuItemIcons(){
    $('#home-icon').css('fill','#666');
    $('#profile-icon').css('fill','#666');
    $('#calendar-icon').css('fill','#666');
    $('#quiz-icon').css('fill','#333');
    $('#news-icon').css('fill','#333');
    $('#home-icon-txt').css('color','#666');
    $('#quiz-icon-txt').css('color','#666');
    $('#news-icon-txt').css('color','#666');
    $('#calendar-icon-txt').css('color','#666');
    $('#profile-icon-txt').css('color','#666');
}


// script to fetch subjects
function getSubjects(){
    $('.hide-element').css('visibility','visible');
    $('.hide-element').css('opacity','1');
    $('.subj-list').html("<div class='message'>Loading...</div>");
    var res= $.ajax({
                        url:"../assets/php/getSubjects.php",
                    });
    res.done((response)=>{
        if(response.trim()==="empty")
        {
            $('.subj-list').html("<div class='message'>No Subject</div>");
        }
        else
        {
            $('.subj-list').html(response);
            $('.subj-action').each(function(){
                $(this).click(function(){
                    selectedSubjId= $(this).attr('id').substring(5);
                    subjectBoxId=$(this).attr('id');
                    let path=$(this).find('img').attr('src');
                    var bgColor=$('#'+subjectBoxId).attr('class').split(' ')[2].trim();
                    let subjectName= $(this).find('.subj-subjectname').text().trim();
                    $.cookie('selectedSubjectId', selectedSubjId);
                    $.cookie('path',path);
                    $.cookie('bgColor',bgColor);
                    $.cookie('subjectName',subjectName);
                    $.cookie('selectedStream',"");
                    $.cookie('randomTopic',0);
                    window.location.href='subject';
                });
            });
        }
    });
}
// end of script
// script to fetch extra courses
function getExtraCourses(){
    $('.slider').html("");
    var res= $.ajax({
                        url:"../assets/php/getExtraCourses.php",
                    });
    res.done((response)=>{
        if(response.trim()==="empty")
        {
            $('.slider').html("");
        }
        else
        {
            $('.slider').html(response);

            $('.course-action').each(function(){
                $(this).click(function()
                {
                  let selectedCourseId=$(this).attr('id').substring(11);
                  let path=$(this).find('img').attr('src');
                  let topicTitle=$(this).find('.e-course-title').text();
                  let topicDesc=$(this).find('.e-course-p').text();
                  $.cookie('selectedTopicDescription',topicDesc);
                  $.cookie('selectedTopicTitle',topicTitle);
                  $.cookie('selectedTopicCoverImg',path);
                  //$.cookie('selectedCourseTopic',selectedSubjectTopic);
                  $.cookie('selectedTopicId',selectedCourseId);
                  $.cookie('fromDash',1);
                  $.cookie('randomTopic',1);
                  window.location.href="topic";
                });
            });
            
            $('#see-more-btn').click(function()
            {
                window.location.href='skill_courses';
            });

        }
    });
}
// function myFunction(minLaptop) {
//     if (minLaptop.matches) { // If media query matches
//       document.body.style.backgroundColor = "yellow";
//     } 
//     else{
//     }
//   }
  
//   var minLaptop = window.matchMedia("(max-width: 1100px)")
//   myFunction(minLaptop) // Call listener function at run time
//   minLaptop.addListener(myFunction)
const  slider=document.querySelector('.slider');
var sectionIndex=0;
var minLaptop = window.matchMedia("(max-width: 1100px)")
var tabletPhone=window.matchMedia("(max-width: 768px)")
$('.left-arrow').click(()=>{
    if (minLaptop.matches) { // If media query matches
       if(tabletPhone.matches)
       {
            if(sectionIndex > 0){
                sectionIndex = sectionIndex - 1;
            }
            else{
                sectionIndex =0;
            }
                    slider.style.transform = 'translate(' + (sectionIndex)*-16.6+'%)';
       }
       else
       {
            if(sectionIndex > 0){
                sectionIndex = sectionIndex - 1;
            }
            else{
                sectionIndex =0;
            }
                    slider.style.transform = 'translate(' + (sectionIndex)*-16.6+'%)';
       }
    } 
    else
    {
        if(sectionIndex > 0){
            sectionIndex = sectionIndex - 1;
        }
        else{
            sectionIndex =0;
        }
                slider.style.transform = 'translate(' + (sectionIndex)*-16.6+'%)';
    }
});
$('.right-arrow').click(()=>{
    if (minLaptop.matches) { // If media query matches
       if(tabletPhone.matches)
       {            
            if(sectionIndex < 5)
            {
                sectionIndex+=1;
            }
            else
            {
                sectionIndex=0;
            }
            slider.style.transform = 'translate(' + (sectionIndex)*-16.6+'%)'; 
       }
       else
       {
                
                if(sectionIndex < 4)
                {
                    sectionIndex+=1;
                }
                else
                {
                    sectionIndex=0;
                }
                slider.style.transform = 'translate(' + (sectionIndex)*-16.6+'%)'; 
       }
    } 
    else{
        if(sectionIndex < 3)
        {
            sectionIndex+=1;
        }
        else
        {
            sectionIndex=0;
        }
       slider.style.transform = 'translate(' + (sectionIndex)*-16.6+'%)'; 
    }
});


// auto sliding after certain interval

slideInterval=setInterval(function (){   
    if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/home')
    {
    autoSlider();
    }
}
, 30000);

function autoSlider()
{
    if (minLaptop.matches) { // If media query matches
        if(tabletPhone.matches)
        {
            if(sectionIndex < 5)
            {
                sectionIndex+=1;
            }
            else
            {
                sectionIndex=0;
            }
            slider.style.transform = 'translate(' + (sectionIndex)*-16.6+'%)'; 
        }
        else
        {
            if(sectionIndex < 4)
            {
                sectionIndex+=1;
            }
            else
            {
                sectionIndex=0;
            }
            slider.style.transform = 'translate(' + (sectionIndex)*-16.6+'%)'; 
        }
     } 
     else{
         if(sectionIndex < 3)
         {
             sectionIndex+=1;
         }
         else
         {
             sectionIndex=0;
         }
        slider.style.transform = 'translate(' + (sectionIndex)*-16.6+'%)'; 
     } 
}

if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/news'){
    resetMenuItemIcons();
    setTimeout(()=>{
        $('#news-icon').css('fill','rgb(45, 150, 255');
        $('#news-icon-txt').css('color','rgb(45, 150, 255');
    },10);
    $('.greeting').html("<div class='calendar-title'>News</div>");
}

if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/calendar'){
    resetMenuItemIcons();
    setTimeout(()=>{
        $('#calendar-icon').css('fill','rgb(45, 150, 255');
        $('#calendar-icon-txt').css('color','rgb(45, 150, 255');
    },10);
    $('.greeting').html("<div class='calendar-title'>School Calendar</div>");
    getCalendar();

}

if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/notes')
{
    resetMenuItemIcons();
    setTimeout(()=>{
        $('#quiz-icon').css('fill','rgb(45, 150, 255');
        $('#quiz-icon-txt').css('color','rgb(45, 150, 255');
    },10);

    getSubjectForNotes()

}

if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/exams'){
    // resetMenuItemIcons();
    // setTimeout(()=>{
    //     $('#quiz-icon').css('fill','rgb(45, 150, 255');
    //     $('#quiz-icon-txt').css('color','rgb(45, 150, 255');
    // },10);
    // $('.wrap-exam-img img').css('visibility','visible');
    // $('.wrap-exam-img img').css('opacity','1');

}

if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/profile')
{
    resetMenuItemIcons();
    $('.profile-shadow').css('visibility','hidden');
    $('.profile-shadow').css('opacity','0');
    setTimeout(()=>{
        $('#profile-icon').css('fill','rgb(45, 150, 255');
        $('#profile-icon-txt').css('color','rgb(45, 150, 255');
    },10);
    $('.wrap-profile').css('visibility','visible');
    $('.wrap-profile').css('opacity','1');

    $('.edit-profile-btn').click(()=>
    {
        $('.profile-shadow').css('visibility','visible');
        $('.profile-shadow').css('opacity','1');
        $('.profile-shadow').css('z-index','9');
        $('.profile-edit-box').css('visibility','visible');
        $('.profile-edit-box').css('opacity','1');
    })
    $('.view-scores-btn').click(()=>
    {
        $('.profile-shadow').css('visibility','visible');
        $('.profile-shadow').css('opacity','1');
        $('.profile-shadow').css('z-index','9');
        $('.profile-learn-box').css('visibility','visible');
        $('.profile-learn-box').css('opacity','1');
        getStudentRecord();
    })
    function getStudentRecord()
    {
        var getStudentRecord=$.ajax(
            {
                url:"../assets/php/getStudentQuizRecord.php",
            });
        getStudentRecord.done(function(response)
        {
            $('.profile-learn-box ul').html(response);
        });
    }

    setStudentStat();
    $('.edit-profile-btn').click(function()
    {
        setStudentInfo();
    });
}
function setStudentInfo()
{
    var setStudentInfo=$.ajax(
        {
            url:"../assets/php/setStudentInfo.php",
        });
    setStudentInfo.done(function(response)
    {
        if(!(response.trim()==="error"))
        {
            $('.student-email-txt').val(response);
            $('.edit-save-btn').click(function()
            {
                if($('.student-email-txt').val().trim()!="")
                {
                    updateStudentInfo();
                }
                else{
                    message(1,"email can not be empty");
                }
            });
        }
    });
}
function updateStudentInfo()
{
    message(2,'Please wait...');
    var email=$('.student-email-txt').val().trim();
    var password=$('.student-password-txt').val().trim()
   
    var updateStudentInfo=$.ajax(
        {
            url:"../assets/php/updateStudentInfo.php",
            method:"POST",  
            data:{email:email,password:password}, 
        }
    );
    updateStudentInfo.done(function(response){
            if(response.trim()==="success")
            {
                message(3,'Updated successfully');
                setTimeout(()=>{
                    closeProfileShadow();
                },5000);
            }
    });
}
function setStudentStat()
{
    var setStudentStat=$.ajax(
        {
            url:"../assets/php/setStudentStat.php",
            method:"POST",
            dataType:"text"
        });
    setStudentStat.done(function(response)
    {
        var stat =JSON.parse(response);
        $('.quiz-taken-stat-av').html(stat.average+"%");
        $('.quiz-taken-stat').html("&ensp;"+stat.quiz_no);
        $('.username').html(stat.studentName);
    });
}
function closeProfileShadow()
{
    $('.profile-shadow').css('visibility','hidden');
    $('.profile-shadow').css('opacity','0');
    $('.profile-shadow').css('z-index','-9'); 
}
function loadNews()
{
    var schoolId=1;
    $('.news-box').html("<div class='message'>Loading...</div>");

    var res= $.ajax({
                        url:"../assets/php/loadNews.php",
                        method:"POST",
                        data:{schoolId:schoolId}
                    });
    res.done((response)=>{
        if(response.trim()==="empty")
        {
            $('.news-box').html("<div class='message'>No News</div>");
        }
        else
        {
            $('.news-box').css('visibility','visible');
            $('.news-box').css('opacity','1');
            $('.news-box').html(response);
        }
    }); 
}
if((window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/topic')
)
{
    hideMenu();
}
if((window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/subject')
)
{
    hideMenu();
}
if((window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/module')
)
{
    hideMenu();
    if($.cookie('fromCourse')==1)
        getCourseModule();
    else if($.cookie('fromCourse')==0)
    getModule();
    $('#back-to-previous').click(function()
    {
        recordModuleDuration()  
    }); 
}
function recordModuleDuration()
{
    var recordModuleDuration=$.ajax(
        {
            url:"../assets/php/recordModuleLogDuration.php",
        });
    recordModuleDuration.done((response)=>
        {
            if($.cookie('fromCourse')==1)
            {
                window.location.href="course";
                recordModuleDuration();
            }
            else if($.cookie('fromCourse')==0)
            {
                window.location.href="topic";
                recordModuleDuration();
            }
               
        });
}
if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/subject')
{
    selectedStreamId=$.cookie('selectedStream');
    selectedSubjectId=$.cookie('selectedSubjectId');
    setSubjectIConName($.cookie('path'),$.cookie('bgColor'),$.cookie('subjectName'));
    selectedSubjectName=$.cookie('subjectName');
    getSchoolStreams();
   $('#back-to-previous').click(function(){
    $.cookie('selectedStream',"");
       window.location.href="home";
   }); 

   $('#search-txt').on('keyup',function(){
    var search_value=$('#search-txt').val().trim().replace(/'/g,'$');
    if(search_value != "")   
       searchTopic(search_value); 
       if(search_value=="")
        getSchoolSubjectTopics(); 
    });
   if( (!($.cookie('selectedStream') === "") && $.cookie('selectedSubjectId')!=null)
   )
   {
        $('.t-stream-name').html($.cookie('selectedStreamName'));
        $('.arrow-separator').css('display','block');
        $('.t-subject-name').html(selectedSubjectName);
        $('.search-box').css('display','block');
        getSchoolSubjectTopics();
    }
}
if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/topic')
{

    setTopic($.cookie('selectedTopicCoverImg'),$.cookie('selectedTopicTitle').trim(),$.cookie('selectedTopicDescription'));

        $('#back-to-previous').click(function()
        {
            recordTopicLogDuration();
       }); 
}

function recordTopicLogDuration()
{
    var recordTopicLogDuration=$.ajax({
        url:"../assets/php/recordTopicLogDuration.php",
    });
    recordTopicLogDuration.done((response)=>{
        if($.cookie('randomTopic')==1)
        {
            window.location.href="home";
        }
        else
        {
            window.location.href="subject";
        }
    })
}

function setTopic(path,title,topicDescription){
    $('.greeting').html($.cookie('selectedTopicTitle'));
    var res=$.ajax(
                {
                    url:"../assets/php/setTopic.php",
                    method:"POST",
                    data:{path:path,title:title,topicDescription:topicDescription}
                });
    res.done(function(response)
    {
        $.cookie('fromCourse',0);
        $('.topic-contents').html(response);
        selectedTopic=$.cookie('selectedTopicId');
        getTopicModules();
        getSchoolQuizzes();
    });
}
function getTopicModules()
{
        var res=$.ajax(
        {
            url:"../assets/php/getTopicModules.php",
            method:"POST",
            data:{topicId:selectedTopic}
        });
        res.done(function(response)
        {
           
            if(response.trim()==="error")
            {
                $('.topic-modules').html("<div class='message'>Something went wrong,try Again.</div>");
            }
            else if(response.trim()==="empty")
            {
                $('.topic-modules').html("<div class='message'>No Modules yet.</div>");   
            }
            else
            {
                $('.topic-modules').html(response);
                $('.module').each(function(){
                    $(this).click(function(){
                        var selectedModuleId=$(this).attr('id').substring(7);
                        $.cookie('selectedModuleId',selectedModuleId);
                        window.location.href="module";
                    });
                });
            }
        });
}

function getSchoolQuizzes()
{

    var res=$.ajax(
        {
            url:"../assets/php/getSchoolQuizzes.php",
            method:"POST",
            data:{topicId:selectedTopic}
        });
        res.done(function(response)
        {
           
            if(response.trim()==="error")
            {
                $('.quiz-list').html("<div class='message'>Something went wrong,try Again.</div>");
            }
            else if(response.trim()==="empty")
            {
                $('.quiz-list').html("<div class='message'>No Quizzes yet.</div>");   
            }
            else
            {
                $('.quiz-list').html(response);
                $('.quiz').each(function(){
                    $(this).click(function(){
                        var selectedQuizTitle=$(this).text();
                        var selectedQuizId=$(this).attr('id').substring(6);
                        $.cookie('selectedQuzTitle',selectedQuizTitle);
                        $.cookie('selectedQuizId',selectedQuizId);
                        $.cookie('getGeneralQuestions',0);
                        window.location.href="school_quiz";
                    });
                });
            }
        });

}


function getSchoolStreams(){
    $('.streams').html("<div class='message'>Loading...</div>");
    var getStreams=$.ajax({
                            url:"../assets/php/getSchoolStreams.php",
                            method:"POST"
                            });
    getStreams.done(
        function(response)
        {
            if(response.trim()==="error")
            {
                $('.streams').html("<div class='message'>Something went wrong,try Again.</div>");
            }
            else if(response.trim()==="empty")
            {
                $('.streams').html("<div class='message'>No streams</div>");   
            }
            else
            {
                $('.streams').html(response);
                $('.streams').css('visibility','visible');
                $('.streams').css('opacity','1');
                $('.s-stream-title').css('visibility','visible');
                $('.s-stream-title').css('opacity','1');
                $('.s-icon-name').css('visibility','visible');
                $('.s-icon-name').css('opacity','1');
                $('.hide-element').css('visibility','visible');
                $('.hide-element').css('opacity','1');
                
                $('.stream').each(function(){
                    $(this).click(function(){

                        $('.stream').css('background-color','#eee')
                        $('.stream').css('border-radius','0px')
                        $('.stream').css('border','0px solid #ddd')
                        $(this).css('border','1px solid #ddd')
                        $(this).css('background-color','white') 
                        $(this).css('border-radius','7px')

                        selectedStreamId=$(this).attr('id').substring(7);
                        $('.t-stream-name').html($(this).text());
                        $('.arrow-separator').css('display','block');
                        $('.t-subject-name').html(selectedSubjectName);
                        $('.search-box').css('display','block');
                        $.cookie('selectedStreamName',$(this).text());
                        if($.cookie('selectedSubjectId')!=null)
                        {

                            getSchoolSubjectTopics();
                        }
                        $.cookie('selectedStream',selectedStreamId);
                    });
                });
            }
        }
    );
}
function getSchoolSubjectTopics()
{
    $('.topic-list').html("<div class='message'>Loading...</div>");
    var getTopics=$.ajax({
                            url:"../assets/php/getSchoolSubjectTopics.php",
                            method:"POST",
                            data:{selectedStreamId:selectedStreamId,selectedSubjectId:selectedSubjectId}
                       });
    getTopics.done(function(response)
    {
        if(response.trim()==="error")
        {
            $('.topic-list').html("<div class='message'>Something went wrong,try Again.</div>");
        }
        else if(response.trim()==="empty")
        {
            $('.topic-list').html("<div class='message'>No topic</div>");   
            $('.search-box').css('display','none');
        }
        else
        {
            $('.topic-list').html(response);
            $('.hide-element').css('visibility','visible');
            $('.hide-element').css('opacity','1');
            $('.topic').each(function(){
                $(this).click(function(){
                    selectedSubjectTopic=$(this).attr('id').substring(6);
                    let path=$(this).find('img').attr('src');
                    let topicTitle=$(this).find('.topic-desc-title').text();
                    let topicDesc=$(this).find('.topic-desc-txt').text();
                    $.cookie('selectedTopicDescription',topicDesc);
                    $.cookie('selectedTopicTitle',topicTitle);
                    $.cookie('selectedTopicCoverImg',path);
                    $.cookie('selectedSubjectTopic',selectedSubjectTopic);
                    $.cookie('selectedTopicId',selectedSubjectTopic);
                    window.location.href="topic";
                });
            });
        }
    });

}
function searchTopic(searchValue)
{
    $('.topic-list').html("<div class='message'>Loading...</div>");
    var search_topic=$.ajax(
    {
        url:"../assets/php/searchTopic.php",
        method:"POST",
        data:{selectedStreamId:selectedStreamId,selectedSubjectId:selectedSubjectId,searchValue:searchValue}
    });
    search_topic.done(function(response)
    {
        if(response.trim()==="error")
        {
            $('.topic-list').html("<div class='message'>Something went wrong,try Again.</div>");
        }
        else if(response.trim()==="empty")
        {
            $('.topic-list').html("<div class='message'>doesn't exist</div>");   
        }
        else
        {
            $('.topic-list').html(response);
            $('.topic').each(function(){
                $(this).click(function(){
                    selectedSubjectTopic=$(this).attr('id').substring(6);
                    let path=$(this).find('img').attr('src');
                    let topicTitle=$(this).find('.topic-desc-title').text();
                    let topicDesc=$(this).find('.topic-desc-txt').text();
                    $.cookie('selectedTopicDescription',topicDesc);
                    $.cookie('selectedTopicTitle',topicTitle);
                    $.cookie('selectedTopicCoverImg',path);
                    $.cookie('selectedSubjectTopic',selectedSubjectTopic);
                    $.cookie('selectedTopicId',selectedSubjectTopic);
                    window.location.href="topic";
                });
            });
        }
    });
}
function setSubjectIConName(path,bgColor,subjectName){
    var setIconName=$.ajax({
                        url:"../assets/php/setSubjectIconName.php",
                        method:"POST",
                        data:{path:path,subjectName:subjectName,bgcolor:bgColor}
                     });
                     setIconName.done(function(response){
                           $('.s-icon-name').html(response);
                     });
}

function getModule(){
    selectedModuleId=$.cookie('selectedModuleId');
    var getModule=$.ajax(
        {
            url:"../assets/php/getModule.php",
            method:"POST",
            data:{selectedModuleId:selectedModuleId}  
         });
         getModule.done(function(response)
         {

            $('.module-box').html(response);
            $('.greeting').html($('.m-module-title').attr('class').trim().substring(14));
            $('.expand').click(function(){
                fullScreen();
                });
            $('.minimize').click(()=>
            {
                exitFullscreen();
            });

         });
}
function hideMenu()
{
    $('.menu').css('display','none');
    $('.back').css('visibility','visible');
    $('.back').css('opacity','1');
    // $('.contents-container').css('z-index','99999');
    // $('.contents-container').css('top','9rem');
    // $('.contents-container').css('padding','0rem 2rem 1rem 2rem');
    // $('.contents-container').css('height','calc( 100vh - 9rem)');
    // $('.header-bottom').css('border-top-right-radius','2rem');
    // $('.header-bottom').css('border-top-left-radius','2rem');
}

// skill courses
if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/skill_courses')
{
    hideMenu();
    $('#back-to-previous').click(function(){
        window.location.href="home";
    });
    getAllSkillCourses();
}
function getAllSkillCourses()
{

    $('.all-courses').html("<div class='message'>Loading...</div>");
    var getTopics=$.ajax({
                            url:"../assets/php/getAllExtraCourses.php",
                            method:"POST",
                            data:{selectedStreamId:selectedStreamId,selectedSubjectId:selectedSubjectId}
                       });
    getTopics.done(function(response)
    {
        if(response.trim()==="error")
        {
            $('.all-courses').html("<div class='message'>Something went wrong,try Again.</div>");
        }
        else if(response.trim()==="empty")
        {
            $('.all-courses').html("<div class='message'>No topic</div>");   
        }
        else
        {
            $('.all-courses').html(response);
            $('.all-courses').css('visibility','visible');
            $('.all-courses').css('opacity','1');
            $('.topic').each(function(){
                $(this).click(function(){
                    selectedSubjectTopic=$(this).attr('id').substring(6);
                    let path=$(this).find('img').attr('src');
                    let topicTitle=$(this).find('.topic-desc-title').text();
                    let topicDesc=$(this).find('.topic-desc-txt').text();
                    $.cookie('selectedCourseDescription',topicDesc);
                    $.cookie('selectedCourseTitle',topicTitle);
                    $.cookie('selectedCourseCoverImg',path);
                    $.cookie('selectedCourseTopic',selectedSubjectTopic);
                    $.cookie('selectedCourseId',selectedSubjectTopic);
                    $.cookie('fromDash',0);
                    window.location.href="course";
                });
            });
        }
    });
}

if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/course')
{
    hideMenu();
    $('.greeting').html($.cookie('selectedCourseTitle'));
    setCourse($.cookie('selectedCourseCoverImg'),$.cookie('selectedCourseTitle'),$.cookie('selectedCourseDescription'));
    $.cookie('selectedCourseCoverImg');
        $('#back-to-previous').click(function()
        {
            if( $.cookie('fromDash')==1)
            {
                window.location.href="home";
               
            }
             else
             {
                recordCourseLogDuration();
             }
              
       }); 
    
}
function recordCourseLogDuration()
{
    var res=$.ajax(
        {
            url:"../assets/php/recordTopicLogDuration.php",
        });
        res.done(()=>
        {
            window.location.href="skill_courses";
        });
}


function setCourse(path,title,topicDescription){
    var res=$.ajax(
                {
                    url:"../assets/php/setCourse.php",
                    method:"POST",
                    data:{path:path,title:title,topicDescription:topicDescription}
                });
    res.done(function(response)
    {
        $('.topic-contents').html(response);
        selectedTopic= $.cookie('selectedCourseId');
        $.cookie('fromCourse',1);
        getCourseModules();
        getCourseQuizzes();
    });
}
function getCourseModules()
{
    var res=$.ajax(
        {
            url:"../assets/php/getCourseModules.php",
            method:"POST",
            data:{topicId:selectedTopic}
        });
        res.done(function(response)
        {
           
            if(response.trim()==="error")
            {
                $('.topic-modules').html("<div class='message'>Something went wrong,try Again.</div>");
            }
            else if(response.trim()==="empty")
            {
                $('.topic-modules').html("<div class='message'>No Modules yet.</div>");   
            }
            else
            {
                $('.topic-modules').html(response);
                $('.module').each(function(){
                    $(this).click(function(){
                        var selectedModuleId=$(this).attr('id').substring(7);
                        $.cookie('selectedModuleId',selectedModuleId);
                        window.location.href="module";
                    });
                });
            }
        });
}


function getCourseQuizzes()
{

    var res=$.ajax(
        {
            url:"../assets/php/getQuizzes.php",
            method:"POST",
            data:{topicId:selectedTopic}
        });
        res.done(function(response)
        {
           
            if(response.trim()==="error")
            {
                $('.quiz-list').html("<div class='message'>Something went wrong,try Again.</div>");
            }
            else if(response.trim()==="empty")
            {
                $('.quiz-list').html("<div class='message'>No Quizzes yet.</div>");   
            }
            else
            {
                $('.quiz-list').html(response);
                $('.quiz').each(function(){
                    $(this).click(function(){
                        var selectedQuizTitle=$(this).text();
                        var selectedQuizId=$(this).attr('id').substring(6);
                        $.cookie('selectedQuzTitle',selectedQuizTitle);
                        $.cookie('selectedQuizId',selectedQuizId);
                        $.cookie('getGeneralQuestions',1)
                        window.location.href="quiz";
                    });
                });
            }
        });

}

function getCourseModule(){
    selectedModuleId=$.cookie('selectedModuleId');
    var getModule=$.ajax(
        {
            url:"../assets/php/getCourseModule.php",
            method:"POST",
            data:{selectedModuleId:selectedModuleId}  
         });
         getModule.done(function(response)
         {
            $('.module-box').html(response);
            $('.greeting').html($('.m-module-title').attr('class').trim().substring(14));

            $('.expand').click(function(){
                fullScreen();
                });
            $('.minimize').click(()=>
            {
                exitFullscreen();
            });

         });
}

// QUIZ CODE
if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/school_quiz')
{
    hideMenu();
    setQuizTitle();
    getQuestions();
    $('#back-to-previous').click(function()
        {
            recordQuizLogInSchoolTopic();
        });
}


function getQuestions()
{
    $('.wrap-quiz').html("<div class='message'>Loading ...</div>");
        if($.cookie('getGeneralQuestions')==1)
        {
            var getQuestions=$.ajax(
                {
                    url:"../assets/php/getGenQuestions.php",
                    method:"POST",
                    data:{selectedQuizId:$.cookie('selectedQuizId'),selectedQuizTitle:$.cookie('selectedQuzTitle')},
                    dataType:'text',
                });  
            
        }
        else
        {
            var getQuestions=$.ajax(
                {
                    url:"../assets/php/getQuestions.php",
                    method:"POST",
                    data:{selectedQuizId:$.cookie('selectedQuizId'),selectedQuizTitle:$.cookie('selectedQuzTitle')},
                    dataType:'text',
                });
        }
        getQuestions.done(function(response)
        {
            //
            if(response.trim()==="empty")
            {
                $('.wrap-quiz').html("<div class='message'>No Questions.</div>");
            }
            else if (response.trim()==="error")
            {
                $('.wrap-quiz').html("<div class='message'>Something is wrong try Again.</div>");
            }
            else
            {
                    var rows =JSON.parse(response)
                    var last_qn_no=rows.totalQns;
                    var output=rows.qns;
                    var answerTable=rows.anwerTable;

                    $('.wrap-quiz').html(output);
                    var qn_no=1;
                    var correct_qn_no=0;
                    $('.current-qn-no').html(qn_no);
                    $('.last-qn-no').html(last_qn_no);

                    $('#back-to-previous').click(function()
                    {
                        if($.cookie('getGeneralQuestions')==1)
                        {
                            
                            window.location.href='course';
                        }
                        else
                        {
                            window.location.href="topic";
                        }
                    });
                    $('.tick-box').each(function()
                    {
                        $(this).click(function()
                        {
                            if(!lock)
                            {
                                $('.option').css('color','red');
                                lock=true;
                                var opt_number=$(this).attr('class').split(' ')[1].trim().substring(7);
                                var opt_in_qn_no=$(this).attr('class').split(' ')[2].trim().substring(10);
                                // alert(opt_number+" "+opt_in_qn_no);
                                answerTable.forEach((row)=>{
                                    if(row.qn_no==opt_in_qn_no)
                                    {
                                       if(opt_number==row.ans_no) 
                                       {
                                            $(this).html("<div class='mark'><img src='../assets/img/tick.png'></div>");
                                            $('.option-'+opt_number).css('color','green');
                                            correct_qn_no+=1;
                                       }
                                       else
                                       {
                                            $(this).html("<div class='mark'><img src='../assets/img/cross.png'></div>");
                                            $('.option-'+row.ans_no).css('color','green');
                                       }
                                    }
                                });
                                setTimeout(function()
                                {
                                    if(qn_no < last_qn_no)
                                    {
                                        qn_no+=1;
                                        $('.question').css('visibility','hidden');
                                        $('.question').css('opacity','0');
                                        $('.current-qn-no').html(qn_no);
                                        $('.option').css('color','#333')
                                        $('#question-'+qn_no).css('visibility','visible');
                                        $('#question-'+qn_no).css('opacity','1');
                                        lock=false;
                                    }
                                    else
                                    {
                                        var score=Math.round((correct_qn_no/last_qn_no)*100);
                                        $.cookie('score',score);
                                        recordStudentScore(score);
                                        setTimeout(()=>{
                                            window.location.href='summary';
                                        },300);
                                    }
                                },6000);
                
                            }
                
                        });
                    });
            }
            //
        });
}
function recordStudentScore(score)
{
        if($.cookie('getGeneralQuestions')==1)
        {
            
            var  recordScore=$.ajax(
                {
                    url:"../assets/php/recordQuizScore.php",
                    method:"POST",
                    data:{score:score,quizId:$.cookie('selectedQuizId')},
                });
        }
        else
        {
            var  recordScore=$.ajax(
                {
                    url:"../assets/php/record_score.php",
                    method:"POST",
                    data:{score:score,quizId:$.cookie('selectedQuizId')},
                });
        }
}
// END OF QUIZ

// QUIZ SUMMARYschool_
if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/summary')
{
    hideMenu();
    setQuizTitle();

    $('.mark-box').html("You scored <b>"+$.cookie('score')+"</b>%")
    $('.remark').css('color','green');
    if( 0 <= $.cookie('score') && $.cookie('score') < 50)
    {
        $('.remark').html("need to improve");
        $('.remark').css('color','red');
    }
    else if( 50 <= $.cookie('score') && $.cookie('score') < 60)
    {
        $('.remark').html("Good");
    }
    else if( 60 <= $.cookie('score') && $.cookie('score') < 81)
    {
        $('.remark').html("Very Good");
    }
    else if( 81 <= $.cookie('score') && $.cookie('score') <= 100)
    {
        $('.remark').html("Excellent");
    }
    $('.remark').html();
    $('#back-to-previous').click(function()
    {
        recordQuizLogDurationFromSummary();
    });


    $('.wrap-quiz ').css('padding','0rem 10rem 2rem 10rem');
    getCorrectionPaper();
}
 
function recordQuizLogDurationFromSummary()
{

    var recordQuizLog=$.ajax(
        {
            url:"../assets/php/recordQuizLog.php",
        }
    );
    recordQuizLog.done((response)=>
    {
        if($.cookie('getGeneralQuestions')==1)
        {
            
            window.location.href='course';
        }
        else
        {
            window.location.href="topic";
        }
    });  
}
// END OF QUIZ SUMMARY
function setQuizTitle(){
    $('.greeting').html($.cookie('selectedQuzTitle'));
}
function getCorrectionPaper()
{
    $('.qn-s-list').html("<div class='message'>Loading ...</div>");
    if($.cookie('getGeneralQuestions')==1)
    {
        var getCorrectionPaper=$.ajax(
            {
                url:"../assets/php/getQuizCorrectionPaper.php",
                method:"POST",
                data:{selectedQuizId:$.cookie('selectedQuizId')},
            });
    }
    else
    {
        var getCorrectionPaper=$.ajax(
            {
                url:"../assets/php/getCorrectionPaper.php",
                method:"POST",
                data:{selectedQuizId:$.cookie('selectedQuizId')},
            });
    }

    getCorrectionPaper.done
    (
        function(response)
        {
            if(response.trim()==="empty")
            {
                $('.qn-s-list').html("<div class='message'>Not found</div>"); 
            }  
            else
            {
                $('.qn-s-list').html(response); 
            }
        }
    );
}
function getCalendar(){
    
    $('.event-list.event-list').html("<div class='message'>Loading ...</div>");

    var res=$.ajax(
        {
            url:"../assets/php/getCalendar.php",
            method:"POST"
        });
        res.done(function(response)
        {
           
            if(response.trim()==="error")
            {
                $('.event-list').html("<div class='message'>Something went wrong,try Again.</div>");
            }
            else if(response.trim()==="empty")
            {
                $('.event-list').html("<div class='message'>No Event</div>");   
            }
            else
            {
                $('.event-list').html(response);
                $('.event-list').css('visibility','visible');
                $('.event-list').css('opacity','1');
            }
        });

}

// general quiz page
if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/quiz')
{
    hideMenu();
    setQuizTitle();
    getQuestions();
    $('#back-to-previous').click(function()
        {
            recordQuizLogInCourse();
        });
}
function recordQuizLogInCourse()
{
    var recordQuizLog=$.ajax(
        {
            url:"../assets/php/recordQuizLog.php",
        }
    );
    recordQuizLog.done((response)=>
    {
        window.location.href="course";
    });
}

function recordQuizLogInSchoolTopic()
{
    var recordQuizLog=$.ajax(
        {
            url:"../assets/php/recordQuizLog.php",
        }
    );
    recordQuizLog.done((response)=>
    {
        window.location.href="topic";
    });
}

function newsDurationRecorder()
{
    var newsDurRec=$.ajax(
        {
            url:"../assets/php/newsDurationRecorder.php",
        });
}
function calendarDurationRecorder()
{
    var newsDurRec=$.ajax(
        {
            url:"../assets/php/calendarDurationRecorder.php",
        });
}


// signin duration auto increment

if($.cookie('loggedIn')==1)
{
    signinDurationAutoIncrement();
    logsDurationAutoIncrement();

}

function signinDurationAutoIncrement()
{

    setInterval
    (
        function ()
        {  
            if(!(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/'))
                {

                    var timer=$.ajax(
                        {
                            url:"../assets/php/signDurationAutoIncrement.php",
                        }); 
                }
        }
    , 6000
    );
}

function logsDurationAutoIncrement()
{
    setInterval
    (
        function ()
        {  
            if(!(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/'))
            {
                var timer=$.ajax(
                    {
                        url:"../assets/php/autoTimeRecorder.php",
                    }); 
                    // timer.done(function(response){

                    //     alert(response);
                    // });

            }
        }
    , 6000
    ); 
}



 
function fullScreen()
{
    $('.expand').css('display','none');

    $('.minimize').css('display','flex');

    $('.header').css('display','none');
    $('.contents-container').css('position','absolute');
    $('.contents-container').css('top','0px');
    $('.contents-container').css('height','100vh');
    $('.contents-container').css('overflow','hidden');

    $('.m-module-resource').css('min-height','100vh');
    $('.m-module-resource').css('position','absolute');
    $('.m-module-resource').css('top','0');
    $('.m-module-resource').css('left','0');
    $('.m-module-resource').css('min-width','100%');



    $('.module').css('display','none');
    $('.m-module-desc').css('display','none');  
}

function exitFullscreen(){

    $('.expand').css('display','flex');

    $('.minimize').css('display','none');
    $('.header').css('display','block');

    $('.contents-container').css('width','100%');
    $('.contents-container').css('height','calc(100vh - 12rem)');
    $('.contents-container').css('top','12rem');
    $('.contents-container').css('overflow-y','scroll');
    $('.contents-container').css('left','0');

    $('.m-module-resource').css('min-height','22rem');
    $('.m-module-resource').css('position','relative');
    $('.m-module-resource').css('width','100%');

    $('.module').css('display','block');
    $('.m-module-desc').css('display','block');  
    
}

if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/notes')
{
    resetMenuItemIcons();
    setTimeout(()=>{
        $('#quiz-icon').css('fill','rgb(45, 150, 255');
        $('#quiz-icon-txt').css('color','rgb(45, 150, 255');
    },10);

    getSubjectForNotes()

}


function getSubjectForNotes()
{
    $('.hide-element').css('visibility','visible');
    $('.hide-element').css('opacity','1');
    $('.subj-list').html("<div class='message'>Loading...</div>");
    var res= $.ajax({
                        url:"../assets/php/getSubjectsForNotes.php",
                    });
    res.done((response)=>{
        if(response.trim()==="empty")
        {
            $('.subj-list').html("<div class='message'>No Subject</div>");
        }
        else
        {
            $('.subj-list').html(response);
            $('.subj-action').each(function(){
                $(this).click(function(){
                    selectedSubjId= $(this).attr('id').substring(5);
                    subjectBoxId=$(this).attr('id');
                    let path=$(this).find('img').attr('src');
                    var bgColor=$('#'+subjectBoxId).attr('class').split(' ')[2].trim();
                    let subjectName= $(this).find('.subj-subjectname').text().trim();
                    $.cookie('selectedSubjectId', selectedSubjId);
                    $.cookie('path',path);
                    $.cookie('bgColor',bgColor);
                    $.cookie('subjectName',subjectName);
                    $.cookie('selectedStream',"");
                    $.cookie('randomTopic',0);
                    window.location.href='notes-topic';
                });
            });
        }
    });  
}

if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/notes-topic')
{

    hideMenu()
    resetMenuItemIcons();
    setTimeout(()=>{
       
        $('#quiz-icon').css('fill','rgb(45, 150, 255');
        $('#quiz-icon-txt').css('color','rgb(45, 150, 255');
    },10);

    selectedStreamId=$.cookie('selectedStream');
    selectedSubjectId=$.cookie('selectedSubjectId');
    setSubjectIConName($.cookie('path'),$.cookie('bgColor'),$.cookie('subjectName'));
    selectedSubjectName=$.cookie('subjectName');
    getSchoolStreamsForNotes();
   $('#back-to-previous').click(function(){
    $.cookie('selectedStream',"");
       window.location.href="notes";
   }); 

   $('#search-txt').on('keyup',function(){
    var search_value=$('#search-txt').val().trim().replace(/'/g,'$');
    if(search_value != "")   
       searchTopicForNotes(search_value); 
       if(search_value=="")
        getSchoolSubjectNotesTopics(); 
    });
   if( (!($.cookie('selectedStream') === "") && $.cookie('selectedSubjectId')!=null)
   )
   {
        $('.t-stream-name').html($.cookie('selectedStreamName'));
        $('.arrow-separator').css('display','block');
        $('.t-subject-name').html(selectedSubjectName);
        $('.search-box').css('display','block');
        getSchoolSubjectNotesTopics();
    }

}

function getSchoolSubjectNotesTopics()
{
    
    $('.topic-list').html("<div class='message'>Loading...</div>");
    var getTopics=$.ajax({
                            url:"../assets/php/getSchoolSubjectNotesTopics.php",
                            method:"POST",
                            data:{selectedStreamId:selectedStreamId,selectedSubjectId:selectedSubjectId}
                       });
    getTopics.done(function(response)
    {
        if(response.trim()==="error")
        {
            $('.topic-list').html("<div class='message'>Something went wrong,try Again.</div>");
        }
        else if(response.trim()==="empty")
        {
            $('.topic-list').html("<div class='message'>No topic</div>");   
            $('.search-box').css('display','none');
        }
        else
        {
            $('.topic-list').html(response);
            $('.hide-element').css('visibility','visible');
            $('.hide-element').css('opacity','1');
            $('.notes').each(function(){
                $(this).click(function(){

                    let notesId=$(this).attr('id').substring(6);

                    $.cookie('notesId',notesId);

                 
                    window.location.href="notes-sections";
                });
            });
        }
    });

}

function getSchoolStreamsForNotes()
{
    $('.streams').html("<div class='message'>Loading...</div>");
    var getStreams=$.ajax({
                            url:"../assets/php/getSchoolStreams.php",
                            method:"POST"
                            });
    getStreams.done(
        function(response)
        {
            if(response.trim()==="error")
            {
                $('.streams').html("<div class='message'>Something went wrong,try Again.</div>");
            }
            else if(response.trim()==="empty")
            {
                $('.streams').html("<div class='message'>No streams</div>");   
            }
            else
            {
                $('.streams').html(response);
                $('.streams').css('visibility','visible');
                $('.streams').css('opacity','1');
                $('.s-stream-title').css('visibility','visible');
                $('.s-stream-title').css('opacity','1');
                $('.s-icon-name').css('visibility','visible');
                $('.s-icon-name').css('opacity','1');
                $('.hide-element').css('visibility','visible');
                $('.hide-element').css('opacity','1');
                $('.stream').each(function(){
                    $(this).click(function(){
                        
                        $('.stream').css('background-color','#eee')
                        $('.stream').css('border-radius','0px')
                        $('.stream').css('border','0px solid #ddd')
                        $(this).css('border','1px solid #ddd')
                        $(this).css('background-color','white') 
                        $(this).css('border-radius','7px')

                        selectedStreamId=$(this).attr('id').substring(7);
                        $('.t-stream-name').html($(this).text());
                        $('.arrow-separator').css('display','block');
                        $('.t-subject-name').html(selectedSubjectName);
                        $('.search-box').css('display','block');
                        $.cookie('selectedStreamName',$(this).text());
                        if($.cookie('selectedSubjectId')!=null)
                        {

                            getSchoolSubjectNotesTopics()
                        }
                        $.cookie('selectedStream',selectedStreamId);
                    });
                });
            }
        }
    );   
}


function  searchTopicForNotes(searchValue)
{
    $('.topic-list').html("<div class='message'>Loading...</div>");
    var search_topic=$.ajax(
    {
        url:"../assets/php/searchTopicForNotes.php",
        method:"POST",
        data:{selectedStreamId:selectedStreamId,selectedSubjectId:selectedSubjectId,searchValue:searchValue}
    });
    search_topic.done(function(response)
    {
        if(response.trim()==="error")
        {
            $('.topic-list').html("<div class='message'>Something went wrong,try Again.</div>");
        }
        else if(response.trim()==="empty")
        {
            $('.topic-list').html("<div class='message'>doesn't exist</div>");   
        }
        else
        {
            $('.topic-list').html(response);
            $('.topic-list li').css('visibility','visible')
            $('.topic-list li').css('opacity','1')
            $('.notes').each(function(){
                $(this).click(function(){
                    let notesId=$(this).attr('id').substring(6);

                    $.cookie('notesId',notesId);

                    window.location.href="notes-sections";
                });
            });
        }
    });   
}

if(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/pages/notes-sections')
{

    hideMenu()

    $('#back-to-previous').click(function(){
        $.cookie('selectedStream',"");
           window.location.href="notes-topic";
       }); 
       
    getNotesSections($.cookie('notesId'))
    
}


function getNotesSections(selectedNotesId)
{
    $('.notes-sections').html('<div class="notes-feedback">Loading</div>')
    var getNotesSections=$.ajax(
        {
            url:"../assets/php/getNotesSections.php",
            method:"POST",
            data:{notesId:selectedNotesId}
        }
    
    )
    getNotesSections.done((response)=>
    {
        if(response.trim() === "empty")
        {
            $('.notes-sections').html('<div class="notes-feedback">nothing</div>')
        }
        else
        {
           $('.notes-sections').html(response)

           $('.expand-notes-btn').each(function()
           {
               $(this).click(function()
               {
                   
                   let clickedSection=$(this).attr('id').substring(17);
                   $('.notes-template').slideUp(600)
                   $('#notes-template-'+clickedSection).slideDown(1000)
       
                   $('.expand-notes-btn').css('z-index','0')
                   $('.minimize-notes-btn').css('z-index','-1')
       
                   $('#expand-notes-btn-'+clickedSection).css('z-index','-1')
                   $('#minimize-notes-btn-'+clickedSection).css('z-index','0')

                   afterImageLoadedResize()

               })
           })
       
           $('.minimize-notes-btn').each(function()
           {
               $(this).click(function()
               {
                   $('.notes-template').slideUp(200)
                   $('.expand-notes-btn').css('z-index','0')
                   $('.minimize-notes-btn').css('z-index','-1')
               })
           })
        }
    })

}

function token()
{

    var  checkToken=$.ajax(
        {
            url:"../frontend/assets/php/token.php",
            method:"POST",
        }
    
    )
    checkToken.done((response)=>
    {

        if(response.trim() ==="success")
        {
            $('#username-sign-input-txt').val('');
            $('#passwd-sign-input-txt').val('');
            $('#index-sign-btn').html("redirecting...");
            var loggedIn=1;
            $.cookie('loggedIn',loggedIn);
            window.location.href="pages/";
        }
        else
        {
            message(1,"Something went wrong,try Again.");
            $.ajax({
                url:"../assets/php/signout.php", 
            })
        }

    })
}

if(!(window.location.pathname == '/kisomo%20app/kisomo_schools/frontend/'))
{

    setInterval
    (
        function ()
        {  
            if(!compareTokenLock)
            {
                compareTokenLock=true;
                compareToken();
            }

        }
    , 5000
    ); 

    }


function compareToken()
{
 var compareToken=$.ajax(
     {
        url:"../assets/php/compareToken.php", 
     }
 )
     compareToken.done((response)=>
     {
        compareTokenLock=false;
         if(response.trim()==="expired")
         {
            logout()  
         }
     })
}






// resize images start here

$(window).resize(function() 
{
    afterImageLoadedResize()
})





function afterImageLoadedResize()
{
    var tablet=window.matchMedia("(max-width: 900px) and (min-width: 660px)");
    var minTablet=window.matchMedia("(max-width: 660px) and (min-width: 540px)");
    var phone=window.matchMedia("(max-width: 540px)");
    if(tablet.matches)
    {

        $('.notes-template img').each(function(){
            if(this.complete)
            {
                var image_width_actual = this.naturalWidth;
                if(image_width_actual > 600)
                {
                    $(this).css('width','600px','important')
                    $(this).css('height','auto','important')
                }
            }
            else
            {
                this.addEventListener('load',function()
                {
                    var image_width_actual = this.naturalWidth;
                    if(image_width_actual > 600)
                    {
                        $(this).css('width','600px','important')
                        $(this).css('height','auto','important')
                    }
                })
            }
        })

    }
    else if(minTablet.matches)
    {
        $('.notes-template img').each(function(){
            if(this.complete)
            {
                var image_width= this.width;
                if(image_width >= 600)
                {
                    $(this).css('width','500px','important')
                    $(this).css('height','auto','important')
                }
            }
            else
            {
                this.addEventListener('load',function()
                {
                    var image_width= this.width;
                    if(image_width >= 600)
                    {
                        $(this).css('width','500px','important')
                        $(this).css('height','auto','important')
                    }
                })
            }
        })

    }
    else if(phone.matches)
    {
        $('.notes-template img').each(function(){
            if(this.complete)
            {
                var image_width = this.width;
                if(image_width >= 350)
                {
                    $(this).css('width','350px','important')
                    $(this).css('height','auto','important')
                }
            }
            else
            {
                this.addEventListener('load',function()
                {
                    var image_width = this.width;
                    if(image_width >= 350)
                    {
                        $(this).css('width','350px','important')
                        $(this).css('height','auto','important')
                    }
                })
            }
        })

    }
    else 
    {

        $('.notes-template img').each(function(){
            if(this.complete)
            {
                var image_width_actual = this.naturalWidth;
                if(image_width_actual >= 350)
                {
                    $(this).css('width',image_width_actual,'important')
                    $(this).css('height','auto','important')
                }
            }
            else
            {
                this.addEventListener('load',function()
                {
                    var image_width_actual = this.naturalWidth;
                    if(image_width_actual >= 350)
                    {
                        $(this).css('width',image_width_actual,'important')
                        $(this).css('height','auto','important')
                    }
                })
            }
        })

    }
}

// end of resize images









