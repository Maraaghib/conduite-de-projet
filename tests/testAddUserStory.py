import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url
from login import login

class TestAddUserStory(unittest.TestCase):
    def setUp(self):
        self.firefox_driver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )
        login(self.firefox_driver)

    def tearDown(self):
        self.firefox_driver.quit()

    def testAddUserStory(self):
        # Test button "Ajouter une user story"
        self.firefox_driver.get(Url.HOME_PAGE_URL)
        self.firefox_driver.get(Url.USER_STORY_TAB_URL)
        self.firefox_driver.find_element_by_id("addUserStory").click()
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, Url.ADD_USER_STORY_URL)
        # Test adding an user story with all field
        id = '1'
        desc = "Test d'ajout d'une userStory"
        diff = '2'
        prio = '3'
        self.AddUserStory(id, desc, diff, prio)
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, Url.USER_STORY_TAB_URL)
        text = self.firefox_driver.find_element_by_id("id" + id).text
        self.assertEqual(text, "#" + id)
        # Test adding an user story without filling the priority field
        self.firefox_driver.get(Url.ADD_USER_STORY_URL)
        id = '2'
        prio = ''
        self.AddUserStory(id, desc, diff, prio)
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, Url.USER_STORY_TAB_URL)
        text = self.firefox_driver.find_element_by_id("id" + id).text
        self.assertEqual(text, "#" + id)
        # Test adding an user story with an id already used
        self.firefox_driver.get(Url.ADD_USER_STORY_URL)
        id = '1'
        self.AddUserStory(id, desc, diff, prio)
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, Url.ADD_USER_STORY_URL)
        # Test adding an user story with no id
        self.firefox_driver.get(Url.ADD_USER_STORY_URL)
        id = ''
        self.AddUserStory(id, desc, diff, prio)
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, Url.ADD_USER_STORY_URL)

    def AddUserStory(self, id_user_story, desc, diff, prio):
        id_user_story_field = self.firefox_driver.find_element_by_name("idUserStory")
        id_user_story_field.send_keys(id_user_story)
        desc_user_story_field = self.firefox_driver.find_element_by_name("descUserStory")
        desc_user_story_field.send_keys(desc)
        diff_user_story_field = self.firefox_driver.find_element_by_name("diffUserStory")
        diff_user_story_field.send_keys(diff)
        prio_user_story_field = self.firefox_driver.find_element_by_name("prioUserStory")
        prio_user_story_field.send_keys(prio)
        submit_button = self.firefox_driver.find_element_by_name("newUserStory")
        submit_button.click()


    def testMissingUri(self):
        self.firefox_driver.get(Url.MISSING_URI)
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, Url.ERROR_URL)

    def testIncorrectUri(self):
        self.firefox_driver.get(Url.INCORRECT_ARG_URI)
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, Url.ERROR_URL)

if __name__ == "__main__":
    unittest.main()