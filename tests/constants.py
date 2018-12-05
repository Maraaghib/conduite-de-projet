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
    # Project url
    NEW_PROJECT_URL   = "/project/newProject.php"
    LIST_PROJECTS_URL = "/project/listProjects.php"
    VIEW_PROJECT_URL = "/project/viewProject.php?projectName=projectTest"
    # Connection url
    LOGIN_URL = "/user/login.php"
    REGISTER_URL = "/user/register.php"

class User:
    USERNAME ='Giovani'
    EMAIL    = 'Pascal.Lacasde@jojo.com' 
    PASSWORD = 'Oh noooo'