import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

ADD_USER_STORY_URL = "http://web/userStory/addUserStory.php?projectName=testAddUserStory"
PROJECT_URL = "http://web/project/viewProject.php?projectName=testAddUserStory#tab-swipe-2"
class TestAddUserStory(unittest.TestCase):
    def setUp(self):
        self.firefoxDriver = webdriver.Remote(
            command_executor='http://127.0.0.1:4444/wd/hub',
            desired_capabilities=DesiredCapabilities.FIREFOX
        )
        self.firefoxDriver.get("http://web")
        # Create a new project to make our test
        btn = self.firefoxDriver.find_element_by_id("newProject")
        btn.click()
        projectNameField = self.firefoxDriver.find_element_by_id("projectName")
        projectNameField.send_keys("testAddUserStory")
        descriptionField = self.firefoxDriver.find_element_by_id("projectDescription")
        descriptionField.send_keys("testAddUserStory")
        sprintDurationField = self.firefoxDriver.find_element_by_id("sprintDuration")
        sprintDurationField.send_keys("2")
        createButton = self.firefoxDriver.find_element_by_name("createProject")
        createButton.click()

    def tearDown(self):
        self.firefoxDriver.quit()

    def testAddUserStory(self):
        self.firefoxDriver.get(PROJECT_URL)
        self.firefoxDriver.find_element_by_id("addUserStory").click()
        pageUrl = self.firefoxDriver.current_url
        self.assertEqual(pageUrl, ADD_USER_STORY_URL)
        desc = "Test d'ajout d'une userStory"
        self.AddUserStory('1', desc, '2', '3')

    def AddUserStory(self, idUserStory, desc, diff, prio):
        idUserStoryField = self.firefoxDriver.find_element_by_name("idUserStory")
        idUserStoryField.send_keys(idUserStory)
        descUserStoryField = self.firefoxDriver.find_element_by_name("descUserStory")
        descUserStoryField.send_keys(desc)
        diffUserStoryField = self.firefoxDriver.find_element_by_name("diffUserStory")
        diffUserStoryField.send_keys(diff)
        prioUserStoryField = self.firefoxDriver.find_element_by_name("prioUserStory")
        prioUserStoryField.send_keys(prio)
        submitButton = self.firefoxDriver.find_element_by_name("newUserStory")
        submitButton.click()
        pageUrl = self.firefoxDriver.current_url
        self.assertEqual(pageUrl, PROJECT_URL)
        text = self.firefoxDriver.find_element_by_id("id" + idUserStory).text
        self.assertEqual(text, "#" + idUserStory)

if __name__ == "__main__":
    unittest.main()