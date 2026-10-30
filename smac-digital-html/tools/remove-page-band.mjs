import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");

function walk(dir, out = []) {
  for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
    if (entry.name === "tools" || entry.name === "assets" || entry.name === "node_modules") continue;
    const full = path.join(dir, entry.name);
    if (entry.isDirectory()) walk(full, out);
    else if (entry.name.endsWith(".html")) out.push(full);
  }
  return out;
}

let count = 0;
for (const file of walk(root)) {
  const before = fs.readFileSync(file, "utf8");
  const after = before.replace(/\s*<section class="page-band">[\s\S]*?<\/section>/g, "");
  if (after !== before) {
    fs.writeFileSync(file, after);
    count += 1;
    console.log("removed", path.relative(root, file));
  }
}
console.log(`Done. Updated ${count} files.`);
