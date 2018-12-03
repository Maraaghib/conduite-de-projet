python3 -m coverage erase
if !(python3 -m coverage run testRegister.py); then
    exit 1
fi
if !(python3 -m coverage run testLogin.py); then
    exit 1
fi
if !(python3 -m coverage run -a testNewProject.py); then
    exit 1
fi
if !(python3 -m coverage run -a testAddUserStory.py); then
    exit 1
fi
if !(python3 -m coverage run -a testRemoveUserStory.py); then
    exit 1
fi
python3 -m coverage xml -i