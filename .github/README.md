# GitHub Workflows

## Packagist Auto-Update

The `packagist-update.yml` workflow automatically notifies Packagist to update the package listing whenever:
- Code is pushed to the `master` branch
- A new release is published

### Setup Requirements

This workflow requires the `PACKAGIST_TOKEN` secret to be configured in the repository settings:

1. Go to [Packagist Profile Settings](https://packagist.org/profile/) and copy your API Token
2. In this GitHub repository, go to **Settings** → **Secrets and variables** → **Actions**
3. Click **New repository secret**
4. Name: `PACKAGIST_TOKEN`
5. Value: Paste your Packagist API token
6. Click **Add secret**

Once configured, the workflow will automatically trigger on every push to master and on new releases, ensuring the package on Packagist stays in sync with the GitHub repository.

### Package Details

- **Packagist Package**: [dedsecteam17/green-validator](https://packagist.org/packages/dedsecteam17/green-validator)
- **GitHub Repository**: [DedSecTeam17/GreenValidator](https://github.com/DedSecTeam17/GreenValidator)
