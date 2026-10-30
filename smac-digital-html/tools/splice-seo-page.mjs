import fs from "fs";
import path from "path";
import { fileURLToPath } from "url";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const root = path.resolve(__dirname, "..");
const fp = path.join(root, "services/search-engine-optimization.html");
const body = fs.readFileSync(path.join(__dirname, "seo-main.html"), "utf8").trim();

let html = fs.readFileSync(fp, "utf8");
const start = html.indexOf('<main id="main">');
const end = html.indexOf("</main>");
if (start < 0 || end < 0) throw new Error("main not found");
html = `${html.slice(0, start)}${body}${html.slice(end + "</main>".length)}`;
fs.writeFileSync(fp, html, "utf8");
console.log("updated search-engine-optimization.html");
