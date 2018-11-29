import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url

class TestListTasks(unittest.TestCase):
    def setUp(self):
        self.firefox_driver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )

    def tearDown(self):
        self.firefox_driver.quit()

    def testListTasks(self):
        project_name = "projectTest"

        self.firefox_driver.get(Url.HOME_PAGE_URL)
        list_projects_link = self.firefox_driver.find_element_by_id("listProjects")
        list_projects_link.click()
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, Url.LIST_PROJECTS_URL)

        project_link = self.firefox_driver.find_element_by_link_text(project_name)
        project_link.click()
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, Url.VIEW_PROJECT_URL)

        sprint_tab = self.firefox_driver.find_element_by_link_text(Sprints)
        sprint_tab.click()



if __name__ == "__main__":
    unittest.main()
