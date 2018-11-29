import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url

class TestListProjects(unittest.TestCase):
    def setUp(self):
        self.firefox_driver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )

    def tearDown(self):
        self.firefox_driver.quit()

    def testListProjects(self):
        self.firefox_driver.get(Url.HOME_PAGE_URL)
        listProjectsLink = self.firefox_driver.find_element_by_id("listProjects")
        listProjectsLink.click()
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, Url.LIST_PROJECTS_URL)

if __name__ == "__main__":
    unittest.main()
