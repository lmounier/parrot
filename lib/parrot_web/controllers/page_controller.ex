defmodule ParrotWeb.PageController do
  use ParrotWeb, :controller

  def index(conn, _params) do
    render conn, "index.html"
  end
end