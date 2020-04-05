# Android App

We have an Android version of the MP Task Manager (both with and without Mixpanel implemented on it) for you to test.

Also, if you prefer, [there's video documentation for this app.](https://mixpanel.box.com/s/fh1v970rqnmw1czf8x1n5jqkmqsc5hxv)

## Download the app

[Here is the link for the respository.](https://github.com/argenisf/mp-tasks-android/)

The easiest way to download and use (as well as keeping up to date) is to clone the repository using git.

**Note:** you also need to have git installed. On current versions of Mac OS, it is included with the Xcode Command Line Tools. To check (or install it), just open your terminal and run `git --version`. If it prints out the version, it is already installed. Otherwise, you will be prompted to install them.

With git installed, just open the terminal and navigate to the folder where you want to have the app. Say you want to have it in your Documents folder, within an AndroidApps folder (as an example). You would:

  * Open the terminal app
  * Navigate to the folder, which would be `cd ~/Documents/AndroidApps`
  * Clone it: type `git clone git@github.com:argenisf/mp-tasks-android.git`
  * **Done:** now you can open that project using Android Studio.

## Using the version of the app with Mixpanel on it

Once you download the app, you will be using the "master" branch, which has all the app functionality, but does not have Mixpanel's implementation (not even the SDK). That being said, there is a branch of the app that already has it, called "mixpanel-implemented". To use it, you can switch to that branch:

  * Make sure you are in the folder for the project. If you just followed the previous step to clone the repository, you need to navigate to it, by typing `cd mp-tasks-android`
  * Now let's create a "mixpanel-implemented" from the remote repo: `git checkout -b mixpanel-implemented origin/mixpanel-implemented`
  * **Done:** open the folder in Android Studio and you will see Mixpanel's implementation is on it

## Getting the latest version of the App from remote

If you are on master (no Mixpanel): `git reset --hard origin/master`

If you are on mixpanel-implemented: `git reset --hard origin/mixpanel-implemented`