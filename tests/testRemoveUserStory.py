import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url

class TestRemoveUserStory(unittest.TestCase):
    def setUp(self):
        self.firefox_driver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )
    
    def tearDown(self):
        self.firefox_driver.quit()
    
    def testRemoveUserStory(self):
        self.firefox_driver.get(Url.USER_STORY_TAB_URL)
        self.firefox_driver.find_element_by_link_text("delete").click()
        self.firefox_driver.find_element_by_name("confirmDelete").click()
        self.assertTrue(len(self.firefox_driver.find_elements_by_id("id1")) == 0)