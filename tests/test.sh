python3 -m coverage erase
if !(python3 -m coverage run testNewProject.py); then
    exit
fi
if !(python3 -m coverage run -a testAddUserStory.py); then
    exit
fi
if !(python3 -m coverage run -a testRemoveUserStory.py);
    exit
fi
python3 -m coverage xml -i