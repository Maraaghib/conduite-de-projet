if !(python3 testRegister.py); then
    exit 1
fi
if !(python3 testLogin.py); then
    exit 1
fi
if !(python3 testNewProject.py); then
    exit 1
fi
if !(python3 testAddUserStory.py); then
    exit 1
fi
if !(python3 testUpdateUserStory.py); then
    exit 1
fi
if !(python3 testRemoveUserStory.py); then
    exit 1
fi
