import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url

class TestRemoveUserStory(unittest.TestCase):
    def setUp(self):
        self.firefoxDriver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )
    
    def tearDown(self):
        self.firefoxDriver.quit()
    
    def testRemoveUserStory(self):
        self.firefoxDriver.get(Url.USER_STORY_TAB_URL)
        self.firefoxDriver.find_element_by_link_text("delete").click()
        self.firefoxDriver.find_element_by_name("confirmDelete").click()
        self.assertTrue(len(self.firefoxDriver.find_elements_by_id("id1")) == 0)