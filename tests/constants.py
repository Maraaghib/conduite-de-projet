import configparser

class Url:
    config = configparser.ConfigParser()
    config.read('conf.ini')
    SELENIUM_HUB = config['HTTP']['SELENIUM_HUB']

    HOME_PAGE_URL = "http://web/"
    ERROR_URL =  "http://web/error.php"
    # User story url
    ADD_USER_STORY_URL = "http://web/userStory/addUserStory.php?projectName=projectTest"
    MISSING_URI = "http://web/userStory/addUserStory.php"
    INCORRECT_ARG_URI = "http://web/userStory/addUserStory.php?projectName=FalseProject"
    USER_STORY_TAB_URL = "http://web/project/viewProject.php?projectName=projectTest#tab-swipe-2"
    # Project url
    NEW_PROJECT_URL   = "http://web/project/newProject.php"
    LIST_PROJECTS_URL = "http://web/project/listProjects.php"