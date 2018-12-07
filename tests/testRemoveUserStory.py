import unittest
import sys
import time
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url, SLEEP_TIME
from login import login

sleep_time = 0
base_url = Url.BASE_URL_HEADLESS

class TestRemoveUserStory(unittest.TestCase):
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
    
    def testRemoveUserStory(self):
        self.firefox_driver.get(base_url + Url.USER_STORY_TAB_URL)
        self.firefox_driver.find_element_by_link_text("delete").click()
        time.sleep(sleep_time)
        self.firefox_driver.find_element_by_name("confirmDelete").click()
        time.sleep(sleep_time)
        self.assertTrue(len(self.firefox_driver.find_elements_by_id("id1")) == 0)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        sleep_time = SLEEP_TIME
        base_url = Url.BASE_URL
        sys.argv.pop()
    unittest.main()