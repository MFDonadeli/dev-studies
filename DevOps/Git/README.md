# GIT

## Gitflow

Helps when there's a lot of commits and requests from different users for a team

Master branch is what we have in production, so I should not commit on Master branch.

I should create a branch called develop, and many features, or small other things separated, that I develop should have their own branches.

But what if I have a bug on my master?

Before I commit from develop to master, I create a branch of release to test all the features, but if I found a bug in the master branch I create a branch of hotfix and I merge it both in master and develop.

Gitflow can also be implemented with a help of a tool, but it have some weird actions like commiting to Master branch.

### git branches 

Branch name for production releases: main [can be master]
Branch name for next release development: develop
Feature branches: feature/
Release branches: release/
Hotfix branches: hotfix/

### commands

git flow init : start a new git repository
git flow feature: to start a new feature branch
    - git flow feature start welcome: create feature/welcome (same as git checkout -b feature/welcome)
    - git flow feature finish welcome: end feature/welcome (it merges with develop and remove feature/welcome) (same as git merge)
git flow release: start new production version
    - git flow release start 0.1.0: Start new version 0.1.0
    - git flow release finish 0.1.0: Finish the release of version 0.1.0 putting on a production branch, (this will merge both in my main and my develop to add all possible development modifications done in this release and guarantee that they will be in the main code of my app)
git flow hotfix: start new hotfix
    - git flow hotfix start 0.1.1: will create a new branch on hotfix/0.1.1 (hotfix will preferencially be a version number)
    - git flow hotfix finish 0.1.1: will finish the hotfix, then will merge to main, then will create a new tag (new version tag), then will merge to develop, then hotfix will be deleted.


### case study

I create new release with release start (0.1.0), and I want to create a new feature called contact (git flow feature start contact) then I add code to this feature and finish it (git flow feature finish contact). The feature will be merged to develop. 
When I finish developing the release (git flow release finish 0.1.0), it will ask to merge the release to main branch, will create a tag (version tag) and then will also merge the release to develop. Last, the release will be deleted.

## commit signature

Extra security to guarantee that it's really me doing the commits

gpg --list-secret-key --key-id-form LONG: give me the list of keys in my computer (id of my key will be listed on sec)
gpg --full-generate-key: generate pair of key (RSA is the default, 4096 bits)
gpg --armor --export <id>: will list my key to export to github (at gpg key in settings)

git config --global user.signingkey <id>: will setup my local git to sign my commit
export GPG_TTY=$(tty): export this to the sign in work in my computer, use it as a environment var
git config --global commit.gpgsign true: all commits will be signed
git config --global tag.gpgsign true: all tags will be signed
git log --show-signature -1: show if the commit was really signed
gpgconf --launch gpg-agent: Password of my key will not be asked (need to edit .gnupg/gpp.conf and add the line use-agent to the file)
gpg --edit-key <id>: enable editing the key. (adduid will enable you to include other email, uid<x> select the uid of user, trust to trust this uid, save to save changes)

## Pull Requests & Code Review

git push origin develop: Create a new pull request for 'develop'

After that you can change default branch to develop in github, and also set some rules for protect branch main at branch name pattern

Pull request: Instead of commiting directly to a branch, I make a request to be pulled to that branch, so someone can review that code.

git checkout <branch>: go to that branch, change from one branch to another (to commit to this branch: git push origin <branch>)

### create pull request template

git checkout -b feature/pr : create a new feature
mkdir .github 
vim .github/PULL_REQUEST_TEMPLATE.md (and paste the content of any template found on Internet)
git add .
git commit -m "Add pull request template"
git push origin feature/pr : push the contents to github

Don't forget to delete feature/pr after mergin it to develop, and in the next commit the template will show up

### code review

I can start a review after someone asks me to do it by setting me on github. On starting I can review all the code and comment, approve or request changes and submit review.

When doing a review I do it using the same branche I create the pull request. 

Also I can configure the repository to require pull request review before merging 

#### codeowners

at same .github folder I can create a file called CODEOWNERS with the contents for example (should check Require review from Code owner at github settings)

*.js @user
.github/ @user
*.go @user @grupo

- github pull requests VSCode

## Semantical Versioning

semver.org

MAJOR.MINOR.PATCH

MAJOR = Public API available (0 is very unstable API, if the API became uncompatible with the former version, we add a number here)
MINOR = Addition some funcs but still compatible with the API
PATCH = Bugs

## Conventional commits

conventionalcommits.org

Create a pattern in messages to be able to communicate between dev and versioning 

<tipo>[escopo]: <desc> tipo se é FIX, feat, etc. escopo: para qual momento estou trabalhando
[corpo]

Always the desc is in the imperative

extension: conventional commits

tool: commitlint help review the commit messages to maintain the conventional commit (have to install using npm)

commitsar: get the commit history and check if it is inside the conventional, in general we use together with docker

commitizen: same as the vs plugin, but for terminal. Install via npm and instead of using git commit, use git cz 