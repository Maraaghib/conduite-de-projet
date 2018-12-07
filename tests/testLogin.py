import unittest
import sys
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url, User

base_url = Url.BASE_URL_HEADLESS

class TestLogin(unittest.TestCase):

    def setUp(self):
        if (base_url == Url.BASE_URL):
            self.firefox_driver = webdriver.Firefox()
        else:
            self.firefox_driver = webdriver.Remote(
            command_executor=Url.SELENIUM_HUB,
            desired_capabilities=DesiredCapabilities.FIREFOX
        )

    def tearDown(self):
        self.firefox_driver.quit()
    
    def testLogin(self):
        # Check if we accessibilty if page when not connected
        self.checkAccessPage(base_url + Url.NEW_PROJECT_URL, base_url + Url.LOGIN_URL)
        self.checkAccessPage(base_url + Url.VIEW_PROJECT_URL, base_url + Url.LOGIN_URL)
        self.checkAccessPage(base_url + Url.ADD_USER_STORY_URL, base_url + Url.LOGIN_URL)

        email_field = self.firefox_driver.find_element_by_name("email")
        email_field.send_keys(User.EMAIL)
        password_field = self.firefox_driver.find_element_by_name("password")
        password_field.send_keys(User.PASSWORD)
        button_connect = self.firefox_driver.find_element_by_name("connectUser")
        button_connect.click()
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.LIST_PROJECTS_URL)

    def checkAccessPage(self, url, expectedUrl):
        self.firefox_driver.get(url)
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, expectedUrl)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        base_url = Url.BASE_URL
        sys.argv.pop()
    unittest.main()