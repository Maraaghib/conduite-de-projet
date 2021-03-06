import configparser

class Url:
    config = configparser.ConfigParser()
    config.read('conf.ini')
    SELENIUM_HUB = config['HTTP']['SELENIUM_HUB']

    BASE_URL_HEADLESS = "http://web"
    BASE_URL = "http://localhost:8100"
    ERROR_URL =  "/error.php"
    # User story url
    ADD_USER_STORY_URL = "/userStory/addUserStory.php?projectName=projectTest"
    MISSING_URI = "/userStory/addUserStory.php"
    INCORRECT_ARG_URI = "/userStory/addUserStory.php?projectName=FalseProject"
    USER_STORY_TAB_URL = "/project/viewProject.php?projectName=projectTest#tab-swipe-2"
    UPDATE_USER_STORY_URL = "/userStory/updateUserStory.php?projectName=projectTest&idUserStory=1"
    # Task Url
    ADD_TASK_URL = "/task/addTask.php?projectName=projectTest&idSprint=1"
    TASK_TAB_URL = "/project/viewProject.php?projectName=projectTest#tab-swipe-3"

    # Project url
    NEW_PROJECT_URL   = "/project/newProject.php"
    LIST_PROJECTS_URL = "/project/listProjects.php"
    VIEW_PROJECT_URL = "/project/viewProject.php?projectName=projectTest"
    # Connection url
    LOGIN_URL = "/user/login.php"
    LOGOUT_URL = "/user/logout.php"
    REGISTER_URL = "/user/register.php"

class User:
    USERNAME ='root'
    EMAIL    = 'root@root.com'
    PASSWORD = 'root'

SLEEP_TIME = 2
