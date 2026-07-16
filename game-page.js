(() => {
  "use strict";

  const games = {
    pubg: {
      name: "PUBG Mobile",
      unit: "UC",
      title: "PUBG Mobile UC",
      image: "assets/games/pubg-mobile.jpg",
      alt: "PUBG Mobile promotional artwork",
      subtitle: "Global · Player ID",
      region: "Global Server",
      playerLabel: "Player ID",
      placeholder: "Enter your PUBG Mobile player ID",
      help: "Open your PUBG Mobile profile and copy the numeric Player ID.",
      inputMode: "numeric",
      packages: [
        ["60 UC", 95], ["325 UC", 480], ["660 UC", 950],
        ["1800 UC", 2350], ["3850 UC", 4650], ["8100 UC", 9250],
        ["Royale Pass", 1200]
      ]
    },
    mlbb: {
      name: "Mobile Legends",
      unit: "Diamonds",
      title: "Mobile Legends Diamonds",
      image: "assets/games/mobile-legends.jpg",
      alt: "Mobile Legends promotional artwork",
      subtitle: "Global · User ID",
      region: "Global Server",
      playerLabel: "User ID & Zone ID",
      placeholder: "Example: 12345678 (1234)",
      help: "Enter your Mobile Legends User ID and Zone ID from your profile.",
      inputMode: "text",
      packages: [
        ["86 Diamonds", 160], ["172 Diamonds", 310], ["257 Diamonds", 450],
        ["429 Diamonds", 720], ["706 Diamonds", 1150], ["Weekly Diamond Pass", 180],
        ["Twilight Pass", 850]
      ]
    },
    codm: {
      name: "Call of Duty Mobile",
      unit: "CP",
      title: "Call of Duty CP",
      image: "assets/games/call-of-duty-mobile.jpg",
      alt: "Call of Duty Mobile promotional artwork",
      subtitle: "Garena · Player ID",
      region: "Garena Server",
      playerLabel: "Player ID",
      placeholder: "Enter your Call of Duty Mobile player ID",
      help: "Open your Call of Duty Mobile profile and copy the Player ID.",
      inputMode: "text",
      packages: [
        ["80 CP", 100], ["420 CP", 480], ["880 CP", 950],
        ["2400 CP", 2450], ["5000 CP", 4900], ["10800 CP", 9900]
      ]
    },
    valorant: {
      name: "Valorant",
      unit: "Points",
      title: "Valorant Points",
      image: "assets/games/valorant.webp",
      alt: "Valorant promotional artwork",
      subtitle: "AP · Riot ID",
      region: "AP Server",
      playerLabel: "Riot ID",
      placeholder: "Enter your Riot ID (Name#Tag)",
      help: "Enter your Riot ID and tagline exactly as shown in your Riot profile.",
      inputMode: "text",
      packages: [
        ["475 VP", 450], ["1000 VP", 900], ["2050 VP", 1750],
        ["3650 VP", 3000], ["5350 VP", 4300], ["11000 VP", 8500]
      ]
    }
  };

  const key = new URLSearchParams(window.location.search).get("game");
  const game = games[key] || games.pubg;
  const byId = (id) => document.getElementById(id);

  document.title = `${game.title} — GameNova`;
  document.querySelector('meta[name="description"]').content = `Buy ${game.title} instantly from GameNova.`;
  byId("product-heading-name").textContent = game.name;
  byId("product-heading-unit").textContent = game.unit;
  byId("product-image").src = game.image;
  byId("product-image").alt = game.alt;
  byId("cover-title").textContent = game.name;
  byId("cover-subtitle").textContent = game.subtitle;
  byId("player-label").textContent = game.playerLabel;
  byId("player-id").placeholder = game.placeholder;
  byId("player-id").inputMode = game.inputMode;
  byId("player-help").textContent = game.help;
  byId("summary-product").textContent = game.title;
  byId("summary-region").textContent = game.region;
  byId("summary-total").textContent = `From ৳${Math.min(...game.packages.map((item) => item[1]))}`;

  const packageOptions = byId("package-options");
  packageOptions.replaceChildren();

  game.packages.forEach(([name, price], index) => {
    const id = `package-${key || "pubg"}-${index + 1}`;
    const column = document.createElement("div");
    column.className = "col";

    const input = document.createElement("input");
    input.className = "option-input";
    input.id = id;
    input.name = "package";
    input.type = "radio";
    input.value = name;
    input.dataset.price = price;
    input.required = index === 0;

    const label = document.createElement("label");
    label.className = "package-option";
    label.htmlFor = id;

    const wrapper = document.createElement("span");
    const packageName = document.createElement("span");
    packageName.className = "package-name";
    packageName.textContent = name;
    const packagePrice = document.createElement("span");
    packagePrice.className = "package-price";
    packagePrice.textContent = `৳ ${price}`;

    wrapper.append(packageName, packagePrice);
    label.append(wrapper);
    column.append(input, label);
    packageOptions.append(column);

    input.addEventListener("change", () => {
      byId("summary-total").textContent = `৳${price}`;
    });
  });
})();
