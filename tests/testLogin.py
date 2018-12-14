import unittest
import sys
import time
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url, User, SLEEP_TIME

sleep_time = 0
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

        # Test correct login
        self.loginUser(User.EMAIL, User.PASSWORD)
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.LIST_PROJECTS_URL)

        # Test logout
        self.logoutUser()
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.LOGIN_URL)

        # Test login with incorrect password
        self.loginUser(User.EMAIL, "fake password")
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.LOGIN_URL)

        # Logout
        self.firefox_driver.get(base_url + Url.LOGOUT_URL)
        # Test login with incorrect email
        self.loginUser("Not an email", User.PASSWORD)
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.LOGIN_URL)

        # Logout
        self.firefox_driver.get(base_url + Url.LOGOUT_URL)
        # Test login with an not known email
        self.loginUser("new@user.com", "password")
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.REGISTER_URL + "?email=new@user.com")

    def loginUser(self, email, password):
        email_field = self.firefox_driver.find_element_by_name("email")
        email_field.send_keys(email)
        password_field = self.firefox_driver.find_element_by_name("password")
        password_field.send_keys(password)
        button_connect = self.firefox_driver.find_element_by_name("connectUser")
        time.sleep(sleep_time)
        button_connect.click()
        time.sleep(sleep_time)

    def logoutUser(self):
        deconnectButton = self.firefox_driver.find_element_by_link_text("Se déconnecter")
        deconnectButton.click()
        time.sleep(sleep_time)


    def checkAccessPage(self, url, expected_url):
        self.firefox_driver.get(url)
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, expected_url)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        sleep_time = SLEEP_TIME
        base_url = Url.BASE_URL
        sys.argv.pop()
    unittest.main()