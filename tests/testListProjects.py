import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url

class TestListProjects(unittest.TestCase):
    def setUp(self):
        self.firefoxDriver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )

    def tearDown(self):
        self.firefoxDriver.quit()

    def testListProjects(self):
        self.firefoxDriver.get(Url.HOME_PAGE_URL)
        listProjectsLink = self.firefoxDriver.find_element_by_id("listProjects")
        listProjectsLink.click()
        currentPageUrl = self.firefoxDriver.current_url
        self.assertEqual(currentPageUrl, Url.LIST_PROJECTS_URL)

if __name__ == "__main__":
    unittest.main()
