import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities

PROJECT_URL = "http://web/project/viewProject.php?projectName=testAddUserStory#tab-swipe-2"
class TestRemoveUserStory(unittest.TestCase):
    def setUp(self):
        self.firefoxDriver = webdriver.Remote(
            command_executor='http://127.0.0.1:4444/wd/hub',
            desired_capabilities=DesiredCapabilities.FIREFOX
        )
    
    def tearDown(self):
        self.firefoxDriver.quit()
    
    def testRemoveUserStory(self):
        self.firefoxDriver.get(PROJECT_URL)
        self.firefoxDriver.find_element_by_link_text("delete").click()
        self.firefoxDriver.find_element_by_name("confirmDelete").click()
        self.assertTrue(len(self.firefoxDriver.find_elements_by_id("id1")) == 0)