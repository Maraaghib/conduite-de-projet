import unittest
import sys
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url
from login import login

base_url = Url.BASE_URL_HEADLESS

class TestListTasks(unittest.TestCase):
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

    def testListTasks(self):
        project_name = "projectTest"

        self.firefox_driver.get(base_url)
        list_projects_link = self.firefox_driver.find_element_by_id("listProjects")
        list_projects_link.click()
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.LIST_PROJECTS_URL)

        project_link = self.firefox_driver.find_element_by_link_text(project_name)
        project_link.click()
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.VIEW_PROJECT_URL)

        sprint_tab = self.firefox_driver.find_element_by_link_text("Sprints")
        sprint_tab.click()



if __name__ == "__main__":
    if len(sys.argv) > 1:
        base_url = Url.BASE_URL
        sys.argv.pop()
    unittest.main()
