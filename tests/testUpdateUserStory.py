import unittest
import sys
import time
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url, SLEEP_TIME
from login import login

sleep_time = 0
base_url = Url.BASE_URL_HEADLESS

class TestUpdateUserStory(unittest.TestCase):
    def setUp(self):
        if (base_url == Url.BASE_URL):
            self.firefox_driver = webdriver.Firefox()
        else:
            self.firefox_driver = webdriver.Remote(
                command_executor=Url.SELENIUM_HUB,
                desired_capabilities=DesiredCapabilities.FIREFOX
            )
        login(self.firefox_driver, base_url)

    def tearDown(self):
        self.firefox_driver.quit()

    def testUpdateUserStory(self):
        # Test button "Modifier une user story"
        self.firefox_driver.get(base_url + Url.USER_STORY_TAB_URL)
        self.firefox_driver.find_element_by_id("updateUserStory-1").click()
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, base_url + Url.UPDATE_USER_STORY_URL)
        # Test updating an user story with all field
        desc = "Test de modification d'une userStory"
        diff = '1'
        prio = '1'
        self.UpdateUserStory(desc, diff, prio)
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, base_url + Url.USER_STORY_TAB_URL)
        # Test updating an user story without filling the priority field
        self.firefox_driver.get(base_url + Url.UPDATE_USER_STORY_URL)
        prio = ''
        self.UpdateUserStory(desc, diff, prio)
        page_url = self.firefox_driver.current_url
        self.assertEqual(page_url, base_url + Url.USER_STORY_TAB_URL)

    def UpdateUserStory(self, desc, diff, prio):
        desc_user_story_field = self.firefox_driver.find_element_by_name("descUserStory")
        desc_user_story_field.clear()
        desc_user_story_field.send_keys(desc)
        diff_user_story_field = self.firefox_driver.find_element_by_name("diffUserStory")
        diff_user_story_field.clear()
        diff_user_story_field.send_keys(diff)
        prio_user_story_field = self.firefox_driver.find_element_by_name("prioUserStory")
        prio_user_story_field.clear()
        prio_user_story_field.send_keys(prio)
        submit_button = self.firefox_driver.find_element_by_name("updateUserStory")
        time.sleep(sleep_time)
        submit_button.click()
        time.sleep(sleep_time)


    def testMissingUri(self):
        self.firefox_driver.get(base_url + Url.MISSING_URI)
        page_url = self.firefox_driver.current_url
        time.sleep(sleep_time)
        self.assertEqual(page_url, base_url + Url.ERROR_URL)

    def testIncorrectUri(self):
        self.firefox_driver.get(base_url + Url.INCORRECT_ARG_URI)
        page_url = self.firefox_driver.current_url
        time.sleep(sleep_time)
        self.assertEqual(page_url, base_url + Url.ERROR_URL)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        sleep_time = SLEEP_TIME
        base_url = Url.BASE_URL
        sys.argv.pop()
    unittest.main()
