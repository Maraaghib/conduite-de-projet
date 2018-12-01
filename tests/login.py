from constants import Url, User

def login(driver):
    driver.get(Url.LOGIN_URL)
    email_field = driver.find_element_by_name("email")
    email_field.send_keys(User.EMAIL)
    password_field = driver.find_element_by_name("password")
    password_field.send_keys(User.PASSWORD)
    button_connect = driver.find_element_by_name("connectUser")
    button_connect.click()