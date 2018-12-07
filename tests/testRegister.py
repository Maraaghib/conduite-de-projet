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
        self.firefox_driver.get(base_url + Url.REGISTER_URL)
        current_page_url = self.firefox_driver.current_url
        time.sleep(sleep_time)
        self.assertEqual(current_page_url, base_url + Url.REGISTER_URL)
        name_field = self.firefox_driver.find_element_by_name("name")
        name_field.send_keys(User.USERNAME)
        email_field = self.firefox_driver.find_element_by_name("email")
        email_field.send_keys(User.EMAIL)
        password_field = self.firefox_driver.find_element_by_name("password")
        password_field.send_keys(User.PASSWORD)
        button_create = self.firefox_driver.find_element_by_name("createUser")
        time.sleep(sleep_time)
        button_create.click()
        time.sleep(sleep_time)
        current_page_url = self.firefox_driver.current_url
        time.sleep(sleep_time)
        self.assertEqual(current_page_url, base_url + Url.LOGIN_URL + "?email=" + User.EMAIL)


if __name__ == "__main__":
    if len(sys.argv) > 1:
        sleep_time = SLEEP_TIME
        base_url = Url.BASE_URL
        sys.argv.pop()
    unittest.main()