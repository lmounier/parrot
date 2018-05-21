# This file is responsible for configuring your application
# and its dependencies with the aid of the Mix.Config module.
#
# This configuration file is loaded before any dependency and
# is restricted to this project.
use Mix.Config

# General application configuration
config :parrot,
  ecto_repos: [Parrot.Repo]

# Configures the endpoint
config :parrot, ParrotWeb.Endpoint,
  url: [host: "localhost"],
  secret_key_base: "n/PqbG4XFuyT48E2VYU+QEGVImLComyh0GMt/lTPm0vDR1o7mpSnBqm3ZJzhdjCR",
  render_errors: [view: ParrotWeb.ErrorView, accepts: ~w(html json)],
  pubsub: [name: Parrot.PubSub,
           adapter: Phoenix.PubSub.PG2]

# Configures Elixir's Logger
config :logger, :console,
  format: "$time $metadata[$level] $message\n",
  metadata: [:user_id]

# Import environment specific config. This must remain at the bottom
# of this file so it overrides the configuration defined above.
import_config "#{Mix.env}.exs"

# Ueberauth
config :ueberauth, Ueberauth,
  providers: [
    github: { Ueberauth.Strategy.Github, [default_scope: "user:email"] },
  ]

config :ueberauth, Ueberauth.Strategy.Github.OAuth,
  client_id: System.get_env("GITHUB_CLIENT_ID"),
  client_secret: System.get_env("GITHUB_CLIENT_SECRET")
