python3 -m coverage erase
python3 -m coverage run testNewProject.py
python3 -m coverage run -a testAddUserStory.py
python3 -m coverage run -a testRemoveUserStory.py
python3 -m coverage xml -i