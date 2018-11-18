import unittest
import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.by import By
from selenium.webdriver.support.events import AbstractEventListener

ADD_USER_STORY_URL = "http://localhost:8100/userStory/addUserStory.php?projectName=testAddUserStory"
PROJECT_URL = "http://localhost:8100/project/viewProject.php?projectName=testAddUserStory#tab-swipe-2"
class TestAddUserStory(unittest.TestCase):
    def setUp(self):
        self.driver = webdriver.Firefox()
        self.driver.get("http://localhost:8100")
        
        # Create a new project to make our test
        btn = self.driver.find_element_by_name("newProject")
        btn.click()
        projectNameField = self.driver.find_element_by_id("projectName")
        projectNameField.send_keys("testAddUserStory")
        descriptionField = self.driver.find_element_by_id("projectDescription")
        descriptionField.send_keys("testAddUserStory")
        sprintDurationField = self.driver.find_element_by_id("sprintDuration")
        sprintDurationField.send_keys("2")
        createButton = self.driver.find_element_by_name("createProject")
        createButton.click()

    def tearDown(self):
        self.driver.close()

    def testButtonAddUserStory(self):
        # Test button "Ajouter une User Story" from listBacklog.php
        self.driver.get("http://localhost:8100/project/viewProject.php?projectName=testAddUserStory#tab-swipe-2")
        self.driver.find_element_by_id("addUserStory").click()
        pageUrl = self.driver.current_url
        self.assertEqual(pageUrl, ADD_USER_STORY_URL)

        # Test adding a correct User Story
        idUserStoryField = self.driver.find_element_by_name("idUserStory")
        idUserStoryField.send_keys("1")
        descUserStoryField = self.driver.find_element_by_name("descUserStory")
        descUserStoryField.send_keys("Description de l'user story 1")
        diffUserStoryField = self.driver.find_element_by_name("diffUserStory")
        diffUserStoryField.send_keys("1")
        prioUserStoryField = self.driver.find_element_by_name("prioUserStory")
        prioUserStoryField.send_keys("1")
        submitButton = self.driver.find_element_by_name("newUserStory")
        submitButton.click()
        pageUrl = self.driver.current_url
        self.assertEqual(pageUrl, PROJECT_URL)
        text = self.driver.find_element_by_id("id1").text
        self.assertEqual(text, "#1")

if __name__ == "__main__":
    unittest.main()