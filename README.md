# Silverstripe CWP Template Project

## Meta README

_You can erase this section after completing it_

### Pre-project

CWP accounts/environments take up a long time to get setup. Make sure this has
been requested before removing comment.

CWP will need a personal account for each of your developers. It will also
require a Release Manager role. Make a list of people with e-mail, name and
role. Attach the list with your request to your client. With this information
they will be able to create the request and immediately provide Ackama with the
required permission to start using the account

Please read our
[SilverStripe CWP Project Management](https://github.com/ackama/wiki/wiki/SilverStripe-CWP-Project-Management)
wiki page for more thorough information regarding managing a CWP project.

Also refer to our
[Ackama README Template](https://github.com/ackama/wiki/wiki/Ackama-README-Template)
wiki page to better customise this README

## Purpose

_Fill in purpose of this project_

### Project Setup

#### Create your project from this repository

* Remove this title after setting up the project, to avoid confusion *

Execute the following to create a new project based of this repository, updated
to the latest version of the SilverStripe stack

```bash
$ composer create-project --no-install ackama/silverstripe-cwp-template your-cwp-project
$ cd your-cwp-project
```

Cloning this repository and working from there will not work as expected.

#### Platform Requirements

The docker environment that is provided will be running these versions and you
can use those utilities within the containers directly through scripts available
in `./bin/` to work. They are documented here and as dotfiles in the repository
if you want or need to match your host environment's versions

- PHP: 7.4
- COMPOSER: 1
- NODE: 14
- NPM: 6

#### Rename Resources

* Remove this title after setting up the project, to avoid confusion *

Defaults for namespaces and prefixes have been set so they are easily
replaceable after initialising the project. Please do the following
replacements:

- Replace `shaun-bare-bones` in all files with the name of your
  project.
- Replace `ShaunBareBones` in all files with the namespace of your
  project.

#### Repository Setup

* Remove this title after setting up the project, to avoid confusion *

After cloning the project, you will have to commit this into a repository. You
can safely commit all created files. The available pipeline uses `main` as the
development branch and `deployment` as production. `deployment` is completely
managed by the pipeline after the initial setup.

_Don't forget to give appropriate access to your team!_

```shell
git init .
git add .
git remote add origin git@github.com:ackama/your-cwp-project.git
git commit -m "Project Initialisation"
git branch -M main
git push origin main
git branch -C deployment
git push origin deployment
git branch -D deployment
```

#### Pipeline Setup

The project already contains CI/CD scripts and definitions for Github Actions,
for running automated tests and automated deployment. You will need to setup the
following pipeline variables:

```dotenv
# Private Key to be used to push and interact with your repository.
# Must have write permissions
SSH_PRIVATE_KEY

# CWP setup
CWP_DASH_USER
CWP_STACK_ID
CWP_DASH_TOKEN
```

##### Heroku Setup

If you are planning to enable a Staging environment in Heroku, you will also
need to set some values in your Pipeline and Heroku environments:

Pipeline

```dotenv
HEROKU_APP_ID
HEROKU_API_KEY
```

Heroku

```dotenv
# Use dev or uat for SS_ENVIRONMENT_TYPE
# Setting this to prod will cause a DNS error
SS_ENVIRONMENT_TYPE

# Because heroku workers run behind proxies, SilverStripe needs to be aware of
# their IPs, otherwise requests will error. You can use * as the value if you
# are not worried security at initial stage
SS_TRUSTED_PROXY_IPS

# Use your heroku URL
SS_BASE_URL

# Standard Database configuration
SS_DATABASE_SERVER
SS_DATABASE_USERNAME
SS_DATABASE_PASSWORD
SS_DATABASE_NAME
```

It is also possible to execute CI locally. Refer to
[Running tests](#running-tests)

#### Other Configuration

- Replace your Sentry DSN, or remove file otherwise: `./app/_config/sentry.yml`
- Configure `app/_config/email.yml` according to your project.

## Operations

_Edit as necessary_

CI pipelines need to be active and configured

This project follows the following branch convention: **main** Main development
branch **deployment** Deployment branch that gets tagged and tagged releases are
deployed

| **Environment** | **URL** | **Hosting Platform** | **Git Branch**      |
| --------------- | ------- | -------------------- | ------------------- |
| Staging         | _TODO_  | Heroku               | deployment (tagged) |
| UAT             | _TODO_  | CWP                  | deployment (tagged) |
| Production      | _TODO_  | CWP                  | deployment (tagged) |

### SSH access

CWP does not provide SSH access. There will be no SSH access to the servers.

### Secrets

Secrets are stored encrypted in the CI's config

## Project Resources:

| **Resource** | **URL**                                             |
| ------------ | --------------------------------------------------- |
| Repository   | https://github.com/ackama/silverstripe-cwp-template |
| Backlog URL  | [ Placeholder ]                                     |
| Invision     | [ Placeholder ]                                     |

## People Involved

| **Role(s)**     | **Name(s)** |
| --------------- | ----------- |
| Developers      | -           |
| Designer        | -           |
| Project Manager | -           |
| Product Owner   | -           |

### Dependencies

- docker
- docker-compose

### Running this app

Clone the project:
`git clone git@github.com:ackama/your-cwp-project.git`

Once the project is cloned, execute this command:

- `docker-compose up` will setup your runtime environment.

### Using your development environment

- The website will be available at `https://localhost`. You might need to
  override how your browser treats _localhost_ Insecure Certificates, as the
  docker machine uses a self-signed certificate:
  - Chrome & Opera: Browse to chrome://flags/#allow-insecure-localhost and
    Enable the highlighted option.
  - Firefox: you will be given the option to accept the risk of opening your
    localhost URL
- Use `bin/console` to log in into your local dev environment
- If you want to have access to your dependencies in the host, run
  `composer install --no-scripts`, `npm ci` and `composer vendor-expose`. These
  directories are not shared into your containers to avoid lowering performance.
- Run `npm run watch` in a separate view to build your assets in realtime.
- Whenever you make changes in your silverstripe app or theme, run
  `sake dev/build flush=1`
- MailDev is available at http://localhost:1080

#### Runtime in your environment

To kickstart your development, dependencies and building processes need to be
run, ideally from inside your docker machine (`bin/console`). Running these
commands will be ready to build:

```
composer install --no-scripts
composer vendor-expose
npm ci
sake dev/build flush=1
npm run watch
```

#### Build your project

Your project's build process is configured to run automatically in a two-step
process.

- First the project gets tested and its assets get built and bundled in a CI
  pipeline.
- Secondly, CWP deploys the silverstripe project.

Although 
the realtime packager or the bundler should render the same
results, if you find yourself needing to build your project as it would be built
by CI/CD for debugging purposes, run these:

```
composer install --no-scripts
npm ci
npm run package
```

#### Testing in your environment

Because of the nature of CWP, local usage of composer should be done in a
slightly different way. Ideally you would use composer this way in order to get
a working copy of your project as this is the way CWP deploys, potentially
skipping steps in your project or dependencies.

- `composer install --no-scripts`
- `composer vendor-expose`
- `sake dev/build`

Using `composer install` _might_ lead to differences when testing. Your builds,
however, will get tested and build in the CI pipeline using the method described
above, both before merging and after.

#### Solr Search

Solr Search capabilities are available for your local environment. You can
access the Solr console on http://localhost:8983/solr

Your development environment enabled Solr Search **only when in `dev` mode and
the environment value `SS_SOLR_ENABLED` has been set**, otherwise it assumes no
configurations. Your docker-compose file already contains this deafult
configurations. If you wish to configure Solr check the
[required ENV values](https://docs.silverstripe.org/en/4/getting_started/environment_management/)
and the `app/_config.php` file.

By default the engine is activated and running. You will need to manually
execute the Configuration task and the Indexing tasks when you want. Otherwise
the usage of Solr will fail. You do this by accessing your console and
executing:

```
sake dev/tasks/Solr_Configure flush=1
sake dev/tasks/Solr_Reindex flush=1
```

### Load a working copy from other environments

- Obtain a silverstripe packed version of the site. you can do so by downloading
  a snapshot from CWP's dashboard. Navigate into
  `Project > Snapshot > Create Snapshot`, create a snapshot or choose one that's
  available and download it into the root of your project
- Run `sspak load [snapshot-filename]` will load the database and uploaded
  assets into your install
- Subsequently run `sake dev/build "flush=1"`

### Running tests

Use the following to run your tests locally

```shell
docker-compose exec app -T ci/run-tests
```

### Deploying outside of CWP

If you are deploying to environments other than CWP (like Heroku), configure
your environment accordingly:

- If your application workers are behind a proxy in `test` mode, you need to
  make SilverStripe aware of the proxy's IP. in order for it to behave as
  expected. In your environment, set teh `SS_TRUSTED_PROXY_IPS` value to either
  `*` or a comma-separated list of known IPs.
- Remember that `dev` mode will by default not enforce SSL protection.

Find more information about environment management at:

- [CWP environment variables](https://www.cwp.govt.nz/developer-docs/en/2/working_with_projects/cwp_environment_variables)
- [Silverstripe Environment Management](https://docs.silverstripe.org/en/4/getting_started/environment_management/)
