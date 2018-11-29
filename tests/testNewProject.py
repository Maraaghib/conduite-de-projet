import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url

class TestNewProject(unittest.TestCase):
    def setUp(self):
        self.firefox_driver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )

    def tearDown(self):
        self.firefox_driver.quit()

    def testNewProject(self):
        project_name = "projectTest"
        # Open the page for creating a new project
        self.firefox_driver.get(Url.HOME_PAGE_URL)
        new_project_link = self.firefox_driver.find_element_by_id("newProject")
        new_project_link.click()
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, Url.NEW_PROJECT_URL)
        # Testing the creation of a project
        self.firefox_driver.get(Url.NEW_PROJECT_URL)
        project_name_field = self.firefox_driver.find_element_by_id("projectName")
        project_name_field.send_keys(project_name)
        description_field = self.firefox_driver.find_element_by_id("projectDescription")
        description_field.send_keys("Test of description")
        sprint_duration_field = self.firefox_driver.find_element_by_id("sprintDuration")
        sprint_duration_field.send_keys("2")
        create_project_button  = self.firefox_driver.find_element_by_name("createProject")
        create_project_button .click()
        current_page_url = self.firefox_driver.current_url
        # Test if I'm redirected in the listProject.php page
        self.assertEqual(current_page_url, Url.LIST_PROJECTS_URL)
        # Test if the project created appears in the list of projects
        self.firefox_driver.find_element_by_link_text(project_name)

if __name__ == "__main__":
    unittest.main()
