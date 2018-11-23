import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url

class TestAddUserStory(unittest.TestCase):
    def setUp(self):
        self.firefoxDriver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )

    def tearDown(self):
        self.firefoxDriver.quit()

    def testAddUserStory(self):
        # Test button "Ajouter une user story"
        self.firefoxDriver.get(Url.HOME_PAGE_URL)
        self.firefoxDriver.get(Url.USER_STORY_TAB_URL)
        self.firefoxDriver.find_element_by_id("addUserStory").click()
        pageUrl = self.firefoxDriver.current_url
        self.assertEqual(pageUrl, Url.ADD_USER_STORY_URL)
        # Test adding an user story with all field
        id = '1'
        desc = "Test d'ajout d'une userStory"
        diff = '2'
        prio = '3'
        self.AddUserStory(id, desc, diff, prio)
        pageUrl = self.firefoxDriver.current_url
        self.assertEqual(pageUrl, Url.USER_STORY_TAB_URL)
        text = self.firefoxDriver.find_element_by_id("id" + id).text
        self.assertEqual(text, "#" + id)
        # Test adding an user story without filling the priority field
        self.firefoxDriver.get(Url.ADD_USER_STORY_URL)
        id = '2'
        prio = ''
        self.AddUserStory(id, desc, diff, prio)
        pageUrl = self.firefoxDriver.current_url
        self.assertEqual(pageUrl, Url.USER_STORY_TAB_URL)
        text = self.firefoxDriver.find_element_by_id("id" + id).text
        self.assertEqual(text, "#" + id)
        # Test adding an user story with an id already used
        self.firefoxDriver.get(Url.ADD_USER_STORY_URL)
        id = '1'
        self.AddUserStory(id, desc, diff, prio)
        pageUrl = self.firefoxDriver.current_url
        self.assertEqual(pageUrl, Url.ADD_USER_STORY_URL)
        # Test adding an user story with no id
        self.firefoxDriver.get(Url.ADD_USER_STORY_URL)
        id = ''
        self.AddUserStory(id, desc, diff, prio)
        pageUrl = self.firefoxDriver.current_url
        self.assertEqual(pageUrl, Url.ADD_USER_STORY_URL)

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


    def testMissingUri(self):
        self.firefoxDriver.get(Url.MISSING_URI)
        pageUrl = self.firefoxDriver.current_url
        self.assertEqual(pageUrl, Url.ERROR_URL)

    def testIncorrectUri(self):
        self.firefoxDriver.get(Url.INCORRECT_ARG_URI)
        pageUrl = self.firefoxDriver.current_url
        self.assertEqual(pageUrl, Url.ERROR_URL)

if __name__ == "__main__":
    unittest.main()