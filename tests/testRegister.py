import unittest
import time
import sys
from selenium import webdriver
from selenium.webdriver.common.desired_capabilities import DesiredCapabilities
from constants import Url, User, SLEEP_TIME

sleep_time = 0
base_url = Url.BASE_URL_HEADLESS

class TestRegister(unittest.TestCase):

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
    
    def testRegister(self):
        # Test accessing register.php while not connected
        self.firefox_driver.get(base_url + Url.REGISTER_URL)
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.REGISTER_URL)

        # Test a correct registering
        self.registerUser(User.USERNAME, User.EMAIL, User.PASSWORD)
        current_page_url = self.firefox_driver.current_url
        time.sleep(sleep_time)
        self.assertEqual(current_page_url, base_url + Url.LOGIN_URL + "?email=" + User.EMAIL)
               
        # Login 
        password_field = self.firefox_driver.find_element_by_name("password")
        password_field.send_keys(User.PASSWORD)
        button_connect = self.firefox_driver.find_element_by_name("connectUser")
        button_connect.click()
        time.sleep(sleep_time)
        # Test accessing register.php while connected
        self.firefox_driver.get(base_url + Url.REGISTER_URL)
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.LIST_PROJECTS_URL)

        # Test registering with the same email
        self.firefox_driver.get(base_url + Url.LOGOUT_URL)
        self.firefox_driver.get(base_url + Url.REGISTER_URL)
        self.registerUser(User.USERNAME, User.EMAIL, User.PASSWORD)
        current_page_url = self.firefox_driver.current_url
        self.assertEqual(current_page_url, base_url + Url.REGISTER_URL)
    
    def registerUser(self, name, email, password):
        name_field = self.firefox_driver.find_element_by_name("name")
        name_field.send_keys(name)
        email_field = self.firefox_driver.find_element_by_name("email")
        email_field.send_keys(email)
        password_field = self.firefox_driver.find_element_by_name("password")
        password_field.send_keys(password)
        button_create = self.firefox_driver.find_element_by_name("createUser")
        time.sleep(sleep_time)
        button_create.click()
        time.sleep(sleep_time)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        sleep_time = SLEEP_TIME
        base_url = Url.BASE_URL
        sys.argv.pop()
    unittest.main()