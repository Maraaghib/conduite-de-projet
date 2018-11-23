import unittest
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url

class TestNewProject(unittest.TestCase):
    def setUp(self):
        self.firefoxDriver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )

    def tearDown(self):
        self.firefoxDriver.quit()

    def testNewProject(self):
        projectName = "projectTest"
        # Open the page for creating a new project
        self.firefoxDriver.get(Url.HOME_PAGE_URL)
        newProjectLink = self.firefoxDriver.find_element_by_id("newProject")
        newProjectLink.click()
        currentPageUrl = self.firefoxDriver.current_url
        self.assertEqual(currentPageUrl, Url.NEW_PROJECT_URL)
        # Testing the creation of a project
        self.firefoxDriver.get(Url.NEW_PROJECT_URL)
        projectNameField = self.firefoxDriver.find_element_by_id("projectName")
        projectNameField.send_keys(projectName)
        descriptionField = self.firefoxDriver.find_element_by_id("projectDescription")
        descriptionField.send_keys("Test of description")
        sprintDurationField = self.firefoxDriver.find_element_by_id("sprintDuration")
        sprintDurationField.send_keys("2")
        createProjectButton = self.firefoxDriver.find_element_by_name("createProject")
        createProjectButton.click()
        currentPageUrl = self.firefoxDriver.current_url
        # Test if I'm redirected in the listProject.php page
        self.assertEqual(currentPageUrl, Url.LIST_PROJECTS_URL)
        # Test if the project created appears in the list of projects
        self.firefoxDriver.find_element_by_link_text(projectName)

if __name__ == "__main__":
    unittest.main()