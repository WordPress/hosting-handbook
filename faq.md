# Hosting Team FAQ

WordCamps and Contributor Days are busy times for the Hosting Team. Table leads often spend a lot of time answering the same onboarding questions. This page collects those answers in one place so contributors can get started quickly and the team can focus on moving tickets forward.

For step-by-step account setup, see the [Contributor Day](https://make.wordpress.org/hosting/handbook/get-involved/contributor-day/) page. For deeper context on team projects and meetings, see [Get Involved](https://make.wordpress.org/hosting/handbook/get-involved/).

## About the Hosting Team

### What does the Hosting Team do?

The Hosting Team works cross-functionally between WordPress.org and web hosts that support WordPress. The team facilitates testing on hosting infrastructure and communication between WordPress.org and hosts.

In practice, that includes maintaining the [Hosting Handbook](https://make.wordpress.org/hosting/handbook/), running [automated hosting tests](https://make.wordpress.org/hosting/test-results/), publishing server compatibility guidance, and collaborating with other WordPress teams. See [Get Involved](https://make.wordpress.org/hosting/handbook/get-involved/) and [Team Projects](https://make.wordpress.org/hosting/handbook/get-involved/team-projects/) for details.

### There's a Hosting Team? I never knew there was a Hosting Team!

Hi, and welcome! The [Hosting Team](https://make.wordpress.org/hosting/) has been part of the WordPress open source project for years. Everyone is welcome — whether you work at a host, run your own sites, or are learning about hosting WordPress for the first time.

Introduce yourself in the [#hosting](https://wordpress.slack.com/archives/hosting/) channel on Slack, or at a Contributor Day table. There is always something to help with.

### Does the Hosting Team recommend a specific host?

No. The Hosting Team does not recommend any specific host. Users and site owners must use their own discretion when choosing hosting.

The team publishes best-practice documentation and compatibility guidance that applies across hosting environments. It does not endorse individual hosting companies.

### When does the team meet?

The Hosting Team meets in the WordPress Slack [#hosting](https://wordpress.slack.com/archives/hosting/) channel on Wednesdays at 0900 and 1700 UTC. Check the [WordPress Meeting calendar](https://make.wordpress.org/meetings/#hosting) for the current schedule.

## Contributing

### How can I contribute if I'm not technical?

You do not need to be a developer or systems administrator to help. Many contributions are documentation-focused:

- Improve or expand [Hosting Handbook](https://make.wordpress.org/hosting/handbook/) pages
- Help with the [Advanced Admin Handbook](https://developer.wordpress.org/advanced-administration/) in collaboration with the Documentation Team
- If you don't code or know how to use Git you can still contribute. Folks are welcome to draft content in Google Docs or another format you are comfortable with — a team member can help turn it into a Pull Request
- Take meeting notes (see [Get Involved](https://make.wordpress.org/hosting/handbook/get-involved/#meetings-taking-notes))

Git is required for many projects, but handbook work can start with a written draft. Ask in [#hosting](https://wordpress.slack.com/archives/hosting/) if you need a hand getting your content into GitHub.

### What projects can I work on?

See [Team Projects](https://make.wordpress.org/hosting/handbook/get-involved/team-projects/) for the current list. The main areas are:

- **Hosting Handbook** — hosting best-practice documentation (this repository)
- **Automated Hosting Tests** — [PHPUnit test runner](https://github.com/WordPress/phpunit-test-runner) and [reporter](https://github.com/WordPress/phpunit-test-reporter)
- **Advanced Admin Handbook** — advanced system administration documentation

At Contributor Days, look for issues labeled for the event (for example, `WCUS26`) in the relevant repositories.

### Where do I find tasks to pick up?

- [Hosting Handbook issues](https://github.com/WordPress/hosting-handbook/issues)
- [PHPUnit test runner issues](https://github.com/WordPress/phpunit-test-runner/issues)
- [PHPUnit test reporter issues](https://github.com/WordPress/phpunit-test-reporter/issues)
- [Advanced Admin Handbook issues](https://github.com/WordPress/Advanced-administration-handbook/issues)

If you want to work on a ticket, folks who are members of the WordPress organization in Github can self-assign on the upper right of the ticket. If you can't self-assign, please comment on the issue to say you are working on it. If you are unsure which issue to choose, ask a table lead or post in [#hosting](https://wordpress.slack.com/archives/hosting/).

### What accounts do I need?

| Account | Required? | Purpose |
| ---- | ---- | ---- |
| [WordPress.org](https://login.wordpress.org/register) | Yes | Profile, contributions tracking, Slack signup |
| [WordPress Slack](https://wordpress.slack.com/signup) | Recommended | Team chat in [#hosting](https://wordpress.slack.com/archives/hosting/) |
| [GitHub](https://github.com/signup) | Recommended | Code and documentation contributions |

Link your GitHub username on your [WordPress.org profile](https://profiles.wordpress.org/me/profile/edit/) so GitHub contributions appear on your WordPress profile.

Full setup steps are on the [Contributor Day](https://make.wordpress.org/hosting/handbook/get-involved/contributor-day/) page.

### How does the Pull Request process work?

1. Find or open an issue describing the change
2. [Fork the repository](https://docs.github.com/en/pull-requests/how-tos/work-with-forks/fork-a-repo) and [create a branch for your work](https://git-scm.com/docs/git-checkout) entitled with the ticket number. (i.e. `WCUS26-393-jazzs3quence`)
3. Make your edits and [open a Pull Request (PR)](https://docs.github.com/en/pull-requests/how-tos/create-pull-requests/creating-a-pull-request)
4. Request review from Hosting Team members in the PR
5. PRs require **approval from two Hosting Team members** before merge

See [Contributing](https://github.com/WordPress/hosting-handbook/blob/main/CONTRIBUTING.md) in this repository for technical details.

### How do I earn a Hosting contributor badge?

Contributions that can earn a badge include accepted PRs, documentation improvements, helping set up automated tests, meeting notes, regular meeting participation, and helping at Contributor Days. See [Team Badges](https://make.wordpress.org/hosting/handbook/get-involved/#team-badges) on the Get Involved page.

If you have contributed and do not yet have a badge, [submit a member request for here](https://profiles.wordpress.org/associations/hosting-contributor/) with details about your work.

## Git and GitHub basics

Many Hosting Team projects use Git and GitHub. You do not need to be an expert, but knowing the basics saves time at Contributor Days.

### Install Git

- **Windows:** [Git for Windows](https://git-scm.com/download/win)
- **macOS:** Git is included with Xcode Command Line Tools, or install via [Homebrew](https://git-scm.com/install/mac) (`brew install git`)
- **Linux:** Use your distribution package manager (for example, `sudo apt install git`)

Verify the install:

```bash
git --version
```

### Fork and clone a repository

1. Sign in to GitHub and open the repository (for example, [hosting-handbook](https://github.com/WordPress/hosting-handbook))
2. Click **Fork** to copy the repository to your GitHub account
3. Clone your fork locally:

```bash
git clone https://github.com/YOUR-USERNAME/hosting-handbook.git
cd hosting-handbook
```

Replace `YOUR-USERNAME` with your GitHub username.

### Create a branch

Always work on a branch, not directly on `main`:

```bash
git checkout -b add-hosting-team-faq
```

Use a short, descriptive branch name related to your change.

### Make a commit

After editing files:

```bash
git status
git add faq.md
git commit -m "Add Hosting Team FAQ page for Contributor Day onboarding"
```

Write a clear commit message that describes what changed and why.

### Push and open a Pull Request

```bash
git push -u origin add-hosting-team-faq
```

Then on GitHub:

1. Open your fork
2. Click **Compare & pull request**
3. Add a description of your change and link the related issue (for example, `Fixes #407`)
4. Request review from Hosting Team members

### Keep your fork up to date

Before starting new work, sync with the upstream repository:

```bash
git remote add upstream https://github.com/WordPress/hosting-handbook.git
git fetch upstream
git checkout main
git merge upstream/main
```

You only need to add the `upstream` remote once per clone.

### Edit a file on GitHub without a local setup

For small documentation changes, you can use GitHub's web editor:

1. Open the file in the repository on GitHub
2. Click the pencil (**Edit**) icon
3. Make your change and use GitHub's flow to propose a Pull Request

This works well for quick fixes at Contributor Days when Git is not yet installed locally.

## Contributor Day quick reference

### I'm at a Contributor Day table — where do I start?

1. Make sure you have a [WordPress.org account](https://login.wordpress.org/register)
2. Join [#hosting](https://wordpress.slack.com/archives/hosting/) on Slack
3. Read this FAQ and ask the table lead which issues need help
4. Pick an issue, comment that you are working on it, and ask for a walkthrough if you need one

Past Contributor Day summaries are linked from [Get Involved](https://make.wordpress.org/hosting/handbook/get-involved/#contributor-day-notes).

### Who do I ask for help?

- **At a camp:** Your table lead or any Hosting Team rep
- **Online:** [#hosting](https://wordpress.slack.com/archives/hosting/) on Slack
- **GitHub:** Comment on the issue or PR you are working on

No question is too basic. Asking early helps you contribute sooner.

[info]Have a question that is not covered here? Comment on [GitHub issue #407](https://github.com/WordPress/hosting-handbook/issues/407) or ask in [#hosting](https://wordpress.slack.com/archives/hosting/) so we can add it to this page.[/info]
